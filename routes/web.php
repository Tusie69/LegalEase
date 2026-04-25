<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
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

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
