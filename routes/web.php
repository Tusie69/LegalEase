<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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
                'meeting_language'   => 'en',
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

Route::post('/book/confirm', function () {
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
})->name('book.confirm');

Route::get('/book/success', fn () => view('book.success'))->name('book.success');

Route::view('/zocdoc-clone', 'zocdoc-clone')->name('zocdoc.clone');

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
    Route::get('/lawyer-dashboard', fn () => view('lawyer-dashboard'))->name('lawyer.dashboard');
    Route::get('/lawyer-credentials', fn () => view('lawyer-credentials'))->name('lawyer.credentials');
    Route::post('/lawyer-credentials', function () {
        return redirect()->route('lawyer.dashboard')->with('status', 'Documents submitted. Our team will review within 2 to 3 business days.');
    })->name('lawyer.credentials.store');
    Route::get('/appointments', [BookingController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/book/{lawyer}', [BookingController::class, 'showBookingForm'])->name('appointments.book');
    Route::post('/appointments/book/{lawyer}', [BookingController::class, 'storeAppointment'])->name('appointments.store');
    Route::get('/appointments/{appointment}/confirmation', [BookingController::class, 'confirmation'])->name('appointments.confirmation');
    Route::post('/appointments/{appointment}/cancel', [BookingController::class, 'cancel'])->name('appointments.cancel');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
