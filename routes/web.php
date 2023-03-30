<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RtSKController;
use App\Http\Controllers\TkrkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AdminSKController;
use App\Http\Controllers\AdminKrkController;
use App\Http\Controllers\TpermohonanController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\DaftarLayananController;
use App\Http\Controllers\GantiPasswordController;
use App\Http\Controllers\AdminPermohonanController;


Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('superadmin')) {
            return redirect('superadmin');
        } elseif (Auth::user()->hasRole('pemohon')) {
            return redirect('pemohon');
        }
    }
    return redirect('/login');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('daftar', [DaftarController::class, 'index']);
Route::post('daftar', [DaftarController::class, 'daftar']);
Route::get('lupa-password', [LupaPasswordController::class, 'index']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
Route::get('/logout', [LogoutController::class, 'logout']);


Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('superadmin', [HomeController::class, 'superadmin']);
    Route::get('superadmin/gp', [GantiPasswordController::class, 'index']);
    Route::post('superadmin/gp', [GantiPasswordController::class, 'update']);
    Route::post('superadmin/sk/updatelurah', [HomeController::class, 'updatelurah']);
    Route::get('superadmin/sk', [AdminSKController::class, 'index']);
    Route::get('superadmin/sk/create', [AdminSKController::class, 'create']);
    Route::post('superadmin/sk/create', [AdminSKController::class, 'store']);
    Route::get('superadmin/sk/edit/{id}', [AdminSKController::class, 'edit']);
    Route::post('superadmin/sk/edit/{id}', [AdminSKController::class, 'update']);
    Route::get('superadmin/sk/delete/{id}', [AdminSKController::class, 'delete']);
    Route::get('superadmin/sk/cetak/{id}', [AdminSKController::class, 'cetak']);

    Route::get('superadmin/rt', [RtController::class, 'index']);
    Route::get('superadmin/rt/create', [RtController::class, 'create']);
    Route::post('superadmin/rt/create', [RtController::class, 'store']);
    Route::get('superadmin/rt/edit/{id}', [RtController::class, 'edit']);
    Route::post('superadmin/rt/edit/{id}', [RtController::class, 'update']);
    Route::get('superadmin/rt/delete/{id}', [RtController::class, 'delete']);
    Route::get('superadmin/rt/reset/{id}', [RtController::class, 'reset']);
});

Route::group(['middleware' => ['auth', 'role:rt']], function () {
    Route::get('rt', [HomeController::class, 'rt']);
    Route::get('rt/gp', [RtController::class, 'ganti_pass']);
    Route::post('rt/gp', [RtController::class, 'ganti_password']);
    Route::get('rt/sk', [RtSKController::class, 'index']);
    Route::get('rt/sk/create', [RtSKController::class, 'create']);
    Route::post('rt/sk/create', [RtSKController::class, 'store']);
    Route::get('rt/sk/edit/{id}', [RtSKController::class, 'edit']);
    Route::post('rt/sk/edit/{id}', [RtSKController::class, 'update']);
    Route::get('rt/sk/delete/{id}', [RtSKController::class, 'delete']);
});
