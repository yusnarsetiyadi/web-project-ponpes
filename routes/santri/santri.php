<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();



Route::get('/login', function () {
    return view('frontend.santri.login');
})->name('santri.login');
// Route::get('/register', function () {
//     return view('frontend.santri.register');
// })->name('santri.register');
Route::post('/login-check', [App\Http\Controllers\Santri\LoginController::class,'login']);
// Route::post('/registrasi', [App\Http\Controllers\Santri\LoginController::class,'register']);

Route::group(['middleware'=>['santriaccess']], function () {
    Route::get('/', function () {
        return view('frontend.santri.home');
    })->name('santri.home');
    Route::get('/home', function () {
        return view('frontend.santri.home');
    })->name('santri.home');
    Route::get('/profile', [App\Http\Controllers\Santri\ProfileController::class, 'show'])->name('santri.profile');
    Route::post('/profile/update/{id}', [App\Http\Controllers\Santri\ProfileController::class, 'update'])->name('santri.update.profile');
    Route::get('/tagihan', [App\Http\Controllers\Santri\TagihanController::class, 'belum'])->name('santri.tagihan.belumlunas');
    Route::get('/pelunasan/tagihan', [App\Http\Controllers\Santri\TagihanController::class, 'lunas'])->name('santri.tagihan.lunas');
    Route::post('/confirm-payment/{id}', [App\Http\Controllers\Santri\KonfirmasiPembayaranController::class, 'confirmPayment'])->name('santri.confirm.payment');
    Route::post('/keluar', [App\Http\Controllers\Santri\LoginController::class,'logout']);

    Route::post('/update-walisantri', [App\Http\Controllers\Santri\ProfileController::class, 'storeWali'])->name('santri.update-walisantri');
    Route::post('/update-pendidikan', [App\Http\Controllers\Santri\ProfileController::class, 'storePend'])->name('santri.update-pendidikan');
    Route::post('/update-password/{id}', [App\Http\Controllers\Santri\ProfileController::class, 'updatePass'])->name('santri.update-password');

});
