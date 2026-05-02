<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return view('dashboard');
    }

    return view('home');
})->name('home');

Route::get('/lawyers', function () {
    return view('lawyers.index');
})->name('lawyers.index');

Route::get('/lawyers/{slug}', function (string $slug) {
    $lawyer = \App\Data\Lawyers::findBySlug($slug);
    abort_if($lawyer === null, 404);

    $booking = session('completed_booking');
    if ($booking && ($booking['lawyer_slug'] ?? null) === $slug) {
        $bookedDate = $booking['date'];
        $bookedTime = $booking['time'];

        $lawyer['availability'] = array_map(function ($day) use ($bookedDate, $bookedTime) {
            $dayDate = \Carbon\Carbon::today()->addDays($day['day_offset'])->toDateString();
            if ($dayDate === $bookedDate) {
                $day['slots'] = array_values(array_filter($day['slots'], fn ($slot) => $slot !== $bookedTime));
            }
            return $day;
        }, $lawyer['availability']);
    }

    return view('lawyers.show', ['lawyer' => $lawyer]);
})->name('lawyers.show');

Route::get('/about', fn () => view('about'))->name('about');
Route::get('/contact', fn () => view('contact'))->name('contact');
Route::get('/legal-services', fn () => view('legal-services'))->name('legal-services');
Route::get('/careers', fn () => view('careers'))->name('careers');
Route::get('/press', fn () => view('press'))->name('press');

Route::get('/for-lawyers', fn () => view('for-lawyers'))->name('for-lawyers');
Route::get('/lawyer-resources', fn () => view('lawyer-resources'))->name('lawyer.resources');

Route::get('/terms', fn () => view('terms'))->name('terms');
Route::get('/privacy', fn () => view('privacy'))->name('privacy');
Route::get('/faq', fn () => view('faq'))->name('faq');
Route::get('/lawyer-login', fn () => view('lawyer-login'))->name('lawyer.login');
Route::post('/lawyer-login', [AuthController::class, 'lawyerLogin'])->name('lawyer.login.store');
Route::get('/lawyer-register', fn () => view('lawyer-register'))->name('lawyer.register');
Route::post('/lawyer-register', [AuthController::class, 'lawyerRegister'])->name('lawyer.register.store');

Route::get('/book/start', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'lawyer' => 'required|string',
        'date'   => 'required|string',
        'time'   => 'required|string',
    ]);

    $lawyer = \App\Data\Lawyers::findBySlug($request->query('lawyer'));
    abort_if($lawyer === null, 404);

    session(['booking' => [
        'lawyer_slug' => $request->query('lawyer'),
        'date'        => $request->query('date'),
        'time'        => $request->query('time'),
    ]]);

    if (auth()->check()) {
        if (!session('booking_details')) {
            session(['booking_details' => [
                'meeting_language'   => 'vi',
                'contact_preference' => 'email',
                'agreed_terms'       => '1',
            ]]);
        }
        return redirect()->route('book.review');
    }

    return redirect()->route('register');
})->name('book.start');

Route::get('/book/details', fn () => view('book.details'))->name('book.details');
Route::post('/book/details', function (\Illuminate\Http\Request $request) {
    if (!session('booking')) {
        return redirect()->route('lawyers.index');
    }

    $validated = $request->validate([
        'meeting_language'   => 'required|in:vi,en',
        'contact_preference' => 'required|in:phone,email',
        'agreed_terms'       => 'required|accepted',
    ]);

    session(['booking_details' => $validated]);

    return redirect()->route('book.review');
})->name('book.details.store');

Route::get('/book/review', fn () => view('book.review'))->name('book.review');

Route::get('/book/payment', function () {
    if (!session('booking') || !session('booking_details')) {
        return redirect()->route('lawyers.index');
    }
    return view('book.payment');
})->name('book.payment');

Route::post('/book/payment', function () {
    if (!session('booking') || !session('booking_details')) {
        return redirect()->route('lawyers.index');
    }

    $bookingCode = 'BK-' . now()->format('Ymd') . '-' . \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(6));

    session([
        'completed_booking' => array_merge(
            session('booking'),
            session('booking_details'),
            ['booking_code' => $bookingCode],
        ),
    ]);
    session()->forget(['booking', 'booking_details']);

    return redirect()->route('book.success');
})->name('book.payment.store');

Route::get('/book/success', fn () => view('book.success'))->name('book.success');

Route::view('/zocdoc-clone', 'zocdoc-clone')->name('zocdoc.clone');
Route::get('/admin-view-test', function () {
    $stats = [
        'total_lawyers' => 128,
        'total_customers' => 542,
        'total_appointments' => 913,
        'revenue_vnd' => 125000000,
        'pending_appointments' => 27,
        'completed_appointments' => 801,
        'cancelled_appointments' => 85,
        'unread_notifications' => 14,
        'paid_payments' => 766,
    ];

    return view('admin_view', compact('stats'));
})->name('admin.view.test');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', fn () => redirect()->route('home'))->name('dashboard');

    Route::get('/consultations/{code}', function (string $code) {
        $consultation = \App\Data\PastConsultations::findByCodeWithReview($code);

        if ($consultation !== null) {
            $consultation['status'] = 'past';
        } else {
            $session = session('completed_booking');
            if ($session && ($session['booking_code'] ?? null) === $code) {
                $consultation = [
                    'lawyer_slug'  => $session['lawyer_slug'],
                    'date'         => $session['date'],
                    'time'         => $session['time'],
                    'booking_code' => $session['booking_code'],
                    'status'       => 'upcoming',
                    'rated'        => false,
                ];
            } else {
                $cancelled = session('cancelled_consultations', []);
                if (isset($cancelled[$code])) {
                    $consultation = $cancelled[$code] + [
                        'booking_code' => $code,
                        'status'       => 'cancelled',
                    ];
                }
            }
        }

        abort_if($consultation === null, 404);

        $lawyer = \App\Data\Lawyers::findBySlug($consultation['lawyer_slug']);
        abort_if($lawyer === null, 404);

        return view('consultations.show', compact('consultation', 'lawyer'));
    })->name('consultations.show');

    Route::get('/consultations/{code}/cancel', function (string $code) {
        $session = session('completed_booking');
        abort_unless($session && ($session['booking_code'] ?? null) === $code, 404);

        $lawyer = \App\Data\Lawyers::findBySlug($session['lawyer_slug']);
        abort_if($lawyer === null, 404);

        $consultation = [
            'lawyer_slug'  => $session['lawyer_slug'],
            'date'         => $session['date'],
            'time'         => $session['time'],
            'booking_code' => $session['booking_code'],
        ];

        return view('consultations.cancel', compact('consultation', 'lawyer'));
    })->name('consultations.cancel');

    Route::post('/consultations/{code}/cancel', function (string $code) {
        $session = session('completed_booking');
        abort_unless($session && ($session['booking_code'] ?? null) === $code, 404);

        $consultationStart = \Carbon\Carbon::parse($session['date'] . ' ' . $session['time']);
        $refundEligible = now()->diffInHours($consultationStart, false) > 24;

        $cancelled = session('cancelled_consultations', []);
        $cancelled[$code] = [
            'lawyer_slug'     => $session['lawyer_slug'],
            'date'            => $session['date'],
            'time'            => $session['time'],
            'cancelled_at'    => now()->toDateString(),
            'refund_eligible' => $refundEligible,
        ];
        session(['cancelled_consultations' => $cancelled]);
        session()->forget('completed_booking');

        return redirect()->route('consultations.show', $code)->with('status', 'Lịch tư vấn của bạn đã được hủy.');
    })->name('consultations.cancel.store');

    Route::get('/consultations/{code}/rate', function (string $code) {
        $consultation = \App\Data\PastConsultations::findByCode($code);
        abort_if($consultation === null, 404);
        $lawyer = \App\Data\Lawyers::findBySlug($consultation['lawyer_slug']);
        abort_if($lawyer === null, 404);
        return view('lawyers.rate', compact('consultation', 'lawyer'));
    })->name('consultations.rate');

    Route::post('/consultations/{code}/rate', function (\Illuminate\Http\Request $request, string $code) {
        $consultation = \App\Data\PastConsultations::findByCode($code);
        abort_if($consultation === null, 404);

        $validated = $request->validate([
            'stars'       => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:2000',
        ], [
            'stars.required' => 'Vui lòng chọn số sao đánh giá.',
            'stars.min'      => 'Vui lòng chọn từ 1 đến 5 sao.',
            'stars.max'      => 'Vui lòng chọn từ 1 đến 5 sao.',
        ]);

        $reviews = session('consultation_reviews', []);
        $reviews[$code] = [
            'stars'       => (int) $validated['stars'],
            'review_text' => $validated['review_text'] ?? null,
            'reviewed_at' => now()->toDateString(),
        ];
        session(['consultation_reviews' => $reviews]);

        return redirect()->route('consultations.show', $code)->with('status', 'Cảm ơn bạn đã đánh giá.');
    })->name('consultations.rate.store');

    Route::get('/lawyer-dashboard', fn () => view('lawyer-dashboard'))->name('lawyer.dashboard');

    Route::get('/lawyer/appointments/{code}', function (string $code) {
        $appointment = \App\Data\LawyerAppointments::findByCodeWithOutcome($code);
        abort_if($appointment === null, 404);
        return view('lawyer.appointments.show', compact('appointment'));
    })->name('lawyer.appointments.show');

    Route::get('/lawyer/appointments/{code}/outcome', function (string $code) {
        $appointment = \App\Data\LawyerAppointments::findByCodeWithOutcome($code);
        abort_if($appointment === null, 404);

        if ($appointment['outcome_reported_at'] !== null) {
            return redirect()->route('lawyer.appointments.show', $code);
        }

        return view('lawyer.appointments.outcome', compact('appointment'));
    })->name('lawyer.appointments.outcome');

    Route::post('/lawyer/appointments/{code}/outcome', function (\Illuminate\Http\Request $request, string $code) {
        $appointment = \App\Data\LawyerAppointments::findByCode($code);
        abort_if($appointment === null, 404);

        $validated = $request->validate([
            'outcome' => 'required|in:completed,no_show_customer',
        ], [
            'outcome.required' => 'Vui lòng chọn kết quả buổi tư vấn.',
            'outcome.in'       => 'Vui lòng chọn kết quả buổi tư vấn.',
        ]);

        $outcomes = session('appointment_outcomes', []);
        $outcomes[$code] = [
            'outcome'     => $validated['outcome'],
            'reported_at' => now()->toDateString(),
        ];
        session(['appointment_outcomes' => $outcomes]);

        $message = $validated['outcome'] === 'completed'
            ? 'Đã ghi nhận kết quả. Khách hàng có thể để lại đánh giá.'
            : 'Đã ghi nhận khách vắng mặt. Khoản bồi hoàn (25% tiền cọc) sẽ được xử lý trong 3 đến 5 ngày làm việc.';

        return redirect()->route('lawyer.appointments.show', $code)->with('status', $message);
    })->name('lawyer.appointments.outcome.store');

    Route::get('/lawyer-credentials', fn () => view('lawyer-credentials'))->name('lawyer.credentials');
    Route::post('/lawyer-credentials', function () {
        return redirect()->route('lawyer.dashboard')->with('status', 'Đã gửi hồ sơ. Đội ngũ sẽ xem xét trong 2 đến 3 ngày làm việc.');
    })->name('lawyer.credentials.store');

    Route::get('/appointments', [BookingController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/book/{lawyer}', [BookingController::class, 'showBookingForm'])->name('appointments.book');
    Route::post('/appointments/book/{lawyer}', [BookingController::class, 'storeAppointment'])->name('appointments.store');
    Route::get('/appointments/{appointment}/confirmation', [BookingController::class, 'confirmation'])->name('appointments.confirmation');
    Route::post('/appointments/{appointment}/cancel', [BookingController::class, 'cancel'])->name('appointments.cancel');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
