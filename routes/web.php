<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\Auth\MobileController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\Auth\MobileResetPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', function () {
    return redirect('/admin');
});

//mobile reset password
Route::get('/mobile/password/reset', [MobileResetPasswordController::class, 'showOTPResetRequestForm']);
Route::post('/mobile/password/reset', [MobileResetPasswordController::class, 'sendOTPReset']);
Route::get('/mobile/password/reset/{id}', [MobileResetPasswordController::class, 'showOTPResetForm']);
Route::post('/mobile/password/reset-form', [MobileResetPasswordController::class, 'checkOTPReset']);
Route::post('/mobile/password/update', [MobileResetPasswordController::class, 'updatePassword']);

Auth::routes(['verify' => true]);

Route::post('/mobile/send-otp-to-verify', [MobileController::class, 'sendOTPVerify']);
Route::get('/mobile/verify/{mobile}', [MobileController::class, 'showOTPVerifyForm']);
Route::post('/mobile/OTP-check', [MobileController::class, 'checkOTPVerify']);

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', function () {
        return redirect('/admin/presensi');
    })->name('admin_home');
    Route::resource('/admin/presensi', PresensiController::class);
    Route::resource('/admin/stok', StokBarangController::class);
    Route::resource('/admin/keuangan', KeuanganController::class);
});

Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/user', [HomeController::class, 'index']);
    Route::resource('/user/presensi', PresensiController::class);
    Route::resource('/user/stok', StokBarangController::class);
    Route::put('/user/stok/{id}', [StokBarangControler::class, 'update']);
    Route::resource('/user/keuangan', KeuanganController::class);
    // Route::put('/user/stok/update/{id}', [StokBarangController::class, 'update']);
});