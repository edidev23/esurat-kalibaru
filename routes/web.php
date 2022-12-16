<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\SuratKeluarController;
use App\Http\Controllers\Admin\JenisSuratKeluarController;
use App\Http\Controllers\Admin\ProfilDesaController;
use App\Http\Controllers\Admin\SuratMasukController;
use App\Http\Controllers\Admin\UsersController;

// kades
use App\Http\Controllers\Admin\Kades\HomeKadesController;
use App\Http\Controllers\Admin\Kades\SuratMasukKadesController;
use App\Http\Controllers\Admin\Kades\SuratKeluarKadesController;

Route::get('/', function () {
    return redirect('admin');
});

Route::get('403', function () {
    return redirect('admin');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::name('admin.')->prefix('admin')->middleware('auth', 'checkRole:admin,kepala_desa,sekdes')->group(function () {
    // users
    Route::get('users/change-password', [UsersController::class, 'change_password']);
    Route::put('users/change-password/{user}', [UsersController::class, 'update_password']);
});

Route::name('kades.')->prefix('kades')->middleware('auth', 'checkRole:kepala_desa,sekdes')->group(function () {
    Route::get('/', [HomeKadesController::class, 'index']);
    Route::resource('/surat-masuk', SuratMasukKadesController::class);
    Route::resource('/surat-keluar', SuratKeluarKadesController::class);
});

// admin
Route::name('admin.')->prefix('admin')->middleware('auth', 'checkRole:admin')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::resource('penduduk', PendudukController::class);
    Route::post('surat-keluar/pilih', [SuratKeluarController::class, 'pilih_surat']);
    Route::get('surat-keluar/cetak/{id}', [SuratKeluarController::class, 'cetak_surat']);
    Route::resource('surat-keluar', SuratKeluarController::class);
    Route::resource('jenis-surat-keluar', JenisSuratKeluarController::class);
    Route::get('jenis-surat-keluar/restore-format/{id}', [JenisSuratKeluarController::class, 'restore_format']);
    Route::resource('surat-masuk', SuratMasukController::class);
    Route::resource('profil-desa', ProfilDesaController::class);
    Route::post('upload-excel', [PendudukController::class, 'uploadExel']);

    // users
    Route::resource('users', UsersController::class);
    Route::post('users/image-cropper/upload', [UsersController::class, 'upload']);
});
