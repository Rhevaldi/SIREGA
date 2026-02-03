<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaWargaController;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\BansosPenerimaController;
use App\Http\Controllers\PublicDashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', [PublicDashboardController::class, 'index'])->name('welcome');

// Super Admin
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

        Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/warga-area', [PublicDashboardController::class, 'warga'])
        ->name('warga.area');
    });


    Route::middleware('role:admin')->group(function () {
        // route::resource('rt', RtController::class)->except(['show']);
        Route::resource('kk', KartuKeluargaController::class)->parameters([
            'kk' => 'kartuKeluarga'
        ]);

        Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
        Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
        route::get('/warga/search', [WargaController::class, 'search'])->name('warga.search');
        route::get('warga/datatables', [WargaController::class, 'datatables'])->name('warga.datatables');
        Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
        Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
        Route::put('/warga/{warga}', [WargaController::class, 'update'])->name('warga.update');
        Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');




        // route::get('desa', [DesaController::class, 'index'])->name('desa.index');
        // route::get('desa/create', [DesaController::class, 'create'])->name('desa.create');
        // route::post('desa', [DesaController::class, 'store'])->name('desa.store');
        // route::get('desa/{id}/edit', [DesaController::class, 'edit'])->name('desa.edit');
        // route::put('desa/{id}', [DesaController::class, 'update'])->name('desa.update');
        // route::delete('desa/{id}', [DesaController::class, 'destroy'])->name('desa.destroy');

        Route::post('/media_warga', [MediaWargaController::class, 'store'])->name('media_warga.store');
        Route::resource('media_warga', MediaWargaController::class);
        // Route::resource('media_warga', MediaWargaController::class)->except(['show', 'edit', 'update']);

        Route::resource('kategori', KategoriController::class)->except('show');


        Route::resource('bansos', BansosController::class)->parameters([
            'bansos' => 'bansos' // Mengatur agar parameter resource 'bansos' tetap bernama 'bansos' bukan 'banso'
        ]);
        Route::post('/bansos-penerima', [BansosPenerimaController::class, 'store'])
            ->name('bansos-penerima.store');

        Route::get('reports/warga', [ReportController::class, 'warga'])->name('reports.warga');
        Route::get('/reports/warga/cetak', [ReportController::class, 'cetakWarga'])->name('reports.warga.cetak');
    });


    // Route::get('/warga/{id}', [WargaController::class, 'show'])->name('warga.show');
    Route::get('/warga/{warga}', [WargaController::class, 'show'])->name('warga.show');
    Route::get('/map/warga', [WargaController::class, 'map'])->name('warga.map');



    Route::middleware('role:superadmin')->group(function () {
        Route::resource('users', UserController::class)->except('show');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});







require __DIR__ . '/auth.php';
