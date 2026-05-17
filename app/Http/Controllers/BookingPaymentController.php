<?php

namespace App\Http\Controllers;

use App\Data\Lawyers;
use App\Models\BookingAppointment;
use App\Models\Payment;
use App\Services\PayPalService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class BookingPaymentController extends Controller
{
    public function show()
    {
        if (! session('booking') || ! session('booking_details')) {
            return redirect()->route('lawyers.index');
        }

        return view('book.payment');
    }

    public function store(Request $request, PayPalService $paypal): RedirectResponse
    {
        if (! session('booking') || ! session('booking_details')) {
            return redirect()->route('lawyers.index');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:paypal,cash',
        ]);

        $booking = session('booking');
        $lawyer = Lawyers::findBySlug($booking['lawyer_slug']);

        if ($lawyer === null) {
            return redirect()->route('lawyers.index');
        }

        if ($validated['payment_method'] === 'cash') {
            [$appointment, $payment] = DB::transaction(function () use ($booking, $lawyer) {
                $appointment = $this->createAppointment($booking, $lawyer, 'PENDING');
                $payment = $this->createPayment($appointment, 'CASH', 'PENDING');

                return [$appointment, $payment];
            });

            $this->completeSession($appointment, $payment, 'cash');

            return redirect()->route('book.success');
        }

        try {
            [$appointment, $payment] = DB::transaction(function () use ($booking, $lawyer) {
                $appointment = $this->createAppointment($booking, $lawyer, 'PAYMENT_PENDING');
                $payment = $this->createPayment($appointment, 'PAYPAL', 'PENDING');

                return [$appointment, $payment];
            });

            $order = $paypal->createOrder(
                $appointment,
                $paypal->amountForPaypal((float) $appointment->final_amount),
                $this->absoluteRouteFromRequest($request, 'paypal.success'),
                $this->absoluteRouteFromRequest($request, 'paypal.cancel'),
            );

            $payment->forceFill([
                'transfer_reference' => $order['id'],
                'submitted_at' => now(),
            ])->save();

            session(['paypal_checkout' => [
                'appointment_id' => $appointment->id,
                'payment_id' => $payment->id,
                'paypal_order_id' => $order['id'],
            ]]);

            return redirect()->away($order['approve_url']);
        } catch (RuntimeException $exception) {
            report($exception);

            return back()
                ->withInput()
                ->withErrors(['payment_method' => 'Khong the khoi tao thanh toan PayPal. Vui long thu lai hoac chon thanh toan tai van phong.']);
        }
    }

    public function paypalSuccess(Request $request, PayPalService $paypal): RedirectResponse
    {
        $orderId = (string) $request->query('token', session('paypal_checkout.paypal_order_id'));

        if ($orderId === '') {
            return redirect()->route('book.payment')
                ->withErrors(['payment_method' => 'PayPal khong tra ve ma giao dich.']);
        }

        $payment = Payment::query()
            ->where('transfer_reference', $orderId)
            ->with('appointment')
            ->first();

        if (! $payment || ! $payment->appointment) {
            return redirect()->route('book.payment')
                ->withErrors(['payment_method' => 'Khong tim thay giao dich PayPal trong he thong.']);
        }

        if ($payment->status === 'PAID') {
            $this->completeSession($payment->appointment, $payment, 'paypal');

            return redirect()->route('book.success');
        }

        try {
            $capture = $paypal->captureOrder($orderId);
            $captureStatus = $capture['status'] ?? null;
            $captureData = $capture['purchase_units'][0]['payments']['captures'][0] ?? [];
            $captureId = $captureData['id'] ?? $orderId;
            $capturedValue = (float) ($captureData['amount']['value'] ?? 0);
            $expectedValue = $paypal->amountForPaypal((float) $payment->appointment->final_amount);

            if ($captureStatus !== 'COMPLETED' || abs($capturedValue - $expectedValue) > 0.01) {
                throw new RuntimeException('PayPal capture verification failed.');
            }

            DB::transaction(function () use ($payment, $captureId): void {
                $payment->forceFill([
                    'status' => 'PAID',
                    'transaction_id' => $captureId,
                    'reviewed_at' => now(),
                    'paid_at' => now(),
                ])->save();

                $payment->appointment->forceFill([
                    'status' => 'CONFIRMED',
                    'paid_at' => now(),
                ])->save();
            });

            $payment->refresh();
            $payment->load('appointment');
            $this->completeSession($payment->appointment, $payment, 'paypal');
            session()->forget('paypal_checkout');

            return redirect()->route('book.success');
        } catch (RuntimeException $exception) {
            report($exception);

            return redirect()->route('book.payment')
                ->withErrors(['payment_method' => 'PayPal chua xac nhan thanh toan thanh cong. Vui long thu lai.']);
        }
    }

    public function paypalCancel(): RedirectResponse
    {
        $checkout = session('paypal_checkout');

        if ($checkout && isset($checkout['payment_id'])) {
            Payment::query()->whereKey($checkout['payment_id'])->update([
                'status' => 'CANCELLED',
                'updated_at' => now(),
            ]);
        }

        session()->forget('paypal_checkout');

        return redirect()->route('book.payment')
            ->withErrors(['payment_method' => 'Ban da huy thanh toan PayPal. Lich hen van chua duoc xac nhan.']);
    }

    private function createAppointment(array $booking, array $lawyer, string $status): BookingAppointment
    {
        $bookingCode = 'BK-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
        $startAt = Carbon::parse($booking['date'] . ' ' . $booking['time'], 'Asia/Ho_Chi_Minh');
        $amount = (float) ($lawyer['price_per_hour'] ?? 0);

        return BookingAppointment::query()->create([
            'booking_code' => $bookingCode,
            'lawyer_id' => $this->resolveLawyerUserId($lawyer),
            'customer_id' => auth()->id(),
            'slot_id' => null,
            'status' => $status,
            'consultation_topic' => $lawyer['primary_specialty'] ?? 'Legal consultation',
            'consultation_summary' => null,
            'scheduled_start_at' => $startAt,
            'scheduled_end_at' => $startAt->copy()->addHour(),
            'timezone' => 'Asia/Ho_Chi_Minh',
            'price_amount' => $amount,
            'deposit_amount' => $amount,
            'final_amount' => $amount,
            'customer_note' => null,
            'paid_at' => null,
        ]);
    }

    private function createPayment(BookingAppointment $appointment, string $method, string $status): Payment
    {
        return Payment::query()->create([
            'appointment_id' => $appointment->id,
            'submitted_by_user_id' => auth()->id(),
            'amount' => $appointment->final_amount,
            'payment_type' => 'FULL',
            'payment_method' => $method,
            'status' => $status,
            'submitted_at' => now(),
            'paid_at' => $status === 'PAID' ? now() : null,
        ]);
    }

    private function completeSession(BookingAppointment $appointment, Payment $payment, string $method): void
    {
        session([
            'completed_booking' => array_merge(
                session('booking', []),
                session('booking_details', []),
                [
                    'booking_code' => $appointment->booking_code,
                    'appointment_id' => $appointment->id,
                    'appointment_status' => $appointment->status,
                    'payment_method' => $method,
                    'payment_status' => $payment->status,
                    'paid_at' => optional($appointment->paid_at)->toDateTimeString(),
                ],
            ),
        ]);

        session()->forget(['booking', 'booking_details']);
    }

    private function resolveLawyerUserId(array $lawyer): int
    {
        $email = 'demo-lawyer-' . Str::slug($lawyer['slug'] ?? $lawyer['name']) . '@legalease.local';
        $existingId = DB::table('users')->where('email', $email)->value('id');

        if ($existingId) {
            return (int) $existingId;
        }

        $roleId = DB::table('roles')->where('code', 'LAWYER')->value('id');

        return (int) DB::table('users')->insertGetId([
            'role_id' => $roleId,
            'name' => $lawyer['name'] ?? 'LegalEase Lawyer',
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(24)),
            'status' => 'ACTIVE',
            'phone' => null,
            'avatar_url' => $lawyer['portrait_url'] ?? null,
            'last_login_at' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function absoluteRouteFromRequest(Request $request, string $routeName): string
    {
        return rtrim($request->getSchemeAndHttpHost(), '/') . route($routeName, [], false);
    }
}
