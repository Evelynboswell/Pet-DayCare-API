<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\BoardingController;

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
    Route::delete('/delete', [AuthController::class, 'deleteAccount']);
    Route::get('/dogs', [DogController::class, 'index']);
    Route::post('/dogs', [DogController::class, 'store']);
    Route::get('/dogs/{dog_id}', [DogController::class, 'show']);
    Route::put('/dogs/{dog_id}', [DogController::class, 'update']);
    Route::delete('/dogs/{dog_id}', [DogController::class, 'destroy']);
});

Route::get('/email/verify/{user}', [AuthController::class, 'verifyEmail'])->name('verify-email');

Route::get('/boardings', [BoardingController::class, 'index']);
Route::get('/boardings/{boarding_id}', [BoardingController::class, 'show']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
