<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcomeDoggoCare');
})->name('welcomeDoggoCare');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update/{id}', [AuthController::class, 'updateUserProfile'])->name('profile.update');
    Route::put('/profile/password/update/{id}', [AuthController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile/delete', [AuthController::class, 'deleteAccount'])->name('profile.delete');
    Route::post('/profile/photo/update/{id}', [AuthController::class, 'updatePhoto'])->name('photo.update');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.passwords.reset', ['token' => $token]);
    })->name('password.reset');

    Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logoutWeb');
});

Route::get('/register', function () {
    return view('register');
})->name('registerView');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('login');
})->name('loginView');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/email', function () {
    return view('verifyEmail');
})->name('verifyEmail');

Route::get('/forgotPassword', function () {
    return view('forgotPassword');
})->name('forgotPassword');
Route::post('/forgotPassword', [PasswordController::class, 'sendResetLinkEmail'])->name('forgotPassword.post');
