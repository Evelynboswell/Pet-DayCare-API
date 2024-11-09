<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Register
Route::post('/register', [AuthController::class, 'register']);

//Login
Route::post('/login', [AuthController::class, 'login']);

//Forgot password
Route::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail']);

//Reset password
Route::post('/reset-password/{token}', [PasswordController::class, 'resetPassword']);

//Users profile (login required)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'getUserProfile']);
    Route::put('/user/{id}/update', [AuthController::class, 'updateUserProfile']);
    Route::post('/update-password', [PasswordController::class, 'updatePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/email/verify/{user}', [AuthController::class, 'verifyEmail'])->name('verify-email');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
