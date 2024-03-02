<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AndroidApiController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Api\MusicController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\CpayController;

Route::post('/patala', [CpayController::class, 'makePayment'])->name('patala');
Route::post('/otp', [CpayController::class, 'confirmPayment'])->name('otp');

Route::post('/beatpay', [MpesaController::class, 'beatPay'])->name('beat.pay');
Route::post('/uploadpay', [MpesaController::class, 'uploadStatus'])->name('upload.status');
Route::post('/pay', [MpesaController::class, 'pay'])->name('m-pesa');
Route::get('/confirmpay', [MpesaController::class, 'confirmPayment'])->name('confirmpayment');
// Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::get('/email-monthly-schedule', [OwnerController::class, 'monthlyEmail']);

Route::post('/mpesu', [MpesaController::class, 'mpesaTransaction'])->name('mpesu');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

// Route::post('/v1/mpesa', [WebhookController::class, 'store']);
Route::post('/v1/{useremail}', [AndroidApiController::class, 'store']);

Route::post('/v2/mpesa', [WebhookController::class, 'manualPay']);
Route::get('/music', [MusicController::class, 'index']);
