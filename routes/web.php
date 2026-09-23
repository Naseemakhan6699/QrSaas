<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'dashboard']);
Route::get('/qr-code', [QrCodeController::class, 'indexQrCode'])->name('homeQr');
Route::view('/pricing', 'pricing')->name('pricing');
Route::get('/billing', [QrCodeController::class, 'billing'])->name('billing');
Route::get('/billing/success', [QrCodeController::class, 'billingSuccess'])->name('billing.success');
Route::get('/billing/cancel', [QrCodeController::class, 'billingCancel'])->name('billing.cancel');
Route::post('/billing/checkout', [QrCodeController::class, 'checkout'])->name('billing.checkout');
Route::post('/stripe/webhook', [QrCodeController::class, 'stripeWebhook'])->name('stripe.webhook');
Route::post('/generate', [QrCodeController::class, 'generate'])->name('qr.generate');
Route::get('/r/{qrCode:slug}', [QrCodeController::class, 'redirect'])->name('qr.redirect');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/qr-codes', [DashboardController::class, 'store'])->name('qr-codes.store');
    Route::get('/dashboard/qr-codes/{qrCode}/download', [DashboardController::class, 'download'])->name('qr-codes.download');
    Route::delete('/dashboard/qr-codes/{qrCode}', [DashboardController::class, 'destroy'])->name('qr-codes.destroy');
    Route::get('/admin', [AdminController::class, 'index'])->middleware('admin')->name('admin.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
