<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AndroidApiController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Api\MusicController;
use App\Http\Controllers\MpesaController;

Route::get('/key', [MpesaController::class, 'pay']);

Route::post('/pay', [MpesaController::class, 'pay'])->name('m-pesa');
Route::get('/confirmpay', [MpesaController::class, 'confirmPayment'])->name('confirmpayment');
// Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::get('/email-monthly-schedule', [OwnerController::class, 'monthlyEmail']);

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::post('/v1/mpesa', [WebhookController::class, 'store']);
Route::post('/v1/{useremail}', [AndroidApiController::class, 'store']);

Route::get('/music', [MusicController::class, 'index']);
