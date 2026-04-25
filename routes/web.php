<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::view('/zocdoc-clone', 'zocdoc-clone')->name('zocdoc.clone');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', [BookingController::class, 'dashboard'])->name('dashboard');
    Route::get('/appointments', [BookingController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/book/{lawyer}', [BookingController::class, 'showBookingForm'])->name('appointments.book');
    Route::post('/appointments/book/{lawyer}', [BookingController::class, 'storeAppointment'])->name('appointments.store');
    Route::get('/appointments/{appointment}/confirmation', [BookingController::class, 'confirmation'])->name('appointments.confirmation');
    Route::post('/appointments/{appointment}/cancel', [BookingController::class, 'cancel'])->name('appointments.cancel');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
