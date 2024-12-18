<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\BoardingController;
use App\Http\Controllers\BookingController;
use App\Console\Commands\CheckBookingExpirations;


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

//Verify Email
Route::get('/email/verify/{user}', [AuthController::class, 'verifyEmail'])->name('verify-email');

//Login
Route::post('/login', [AuthController::class, 'login']);

//Forgot password
Route::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail']);

//Reset password
Route::post('/reset-password/{token}', [PasswordController::class, 'resetPassword']);

//Authenticated routes (login required)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'getUserProfile']);
    Route::put('/user/{id}/update', [AuthController::class, 'updateUserProfile']);
    Route::post('/update-password', [PasswordController::class, 'updatePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::delete('/delete', [AuthController::class, 'deleteAccount']);
    Route::get('/dogs', [DogController::class, 'index']);
    Route::post('/dogs', [DogController::class, 'store']);
    Route::get('/dogs/{dog_id}', [DogController::class, 'show']);
    Route::put('/dogs/{dog_id}', [DogController::class, 'update']);
    Route::delete('/dogs/{dog_id}', [DogController::class, 'destroy']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/bookings/{booking_id}', [BookingController::class, 'show']);
});

//Boarding
Route::get('/boardings', [BoardingController::class, 'index']);
Route::get('/boardings/{boarding_id}', [BoardingController::class, 'show']);
Route::post('/boardings', [BoardingController::class, 'store']);

// //Test Task Scheduler
// Route::get('/test-scheduler', function () {
//     Artisan::call('bookings:check-expirations');
//     return response()->json(['message' => 'Scheduler command executed successfully.']);
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
