<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return view('welcome');
});

// Super Admin
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::middleware('role:admin')->group(function () {
        route::resource('rt', RtController::class)->except(['show']);

        Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
        Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
        Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
        Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
        Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
        Route::delete('/warga/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');

        route::get('desa/create', [DesaController::class, 'create'])->name('desa.create');
        route::post('desa', [DesaController::class, 'store'])->name('desa.store');
        route::get('desa', [DesaController::class, 'index'])->name('desa.index');
        route::get('desa/{id}/edit', [DesaController::class, 'edit'])->name('desa.edit');
        route::put('desa/{id}', [DesaController::class, 'update'])->name('desa.update');
        route::delete('desa/{id}', [DesaController::class, 'destroy'])->name('desa.destroy');
    });


    Route::get('/warga/{id}', [WargaController::class, 'show'])->name('warga.show');
    Route::get('/map/warga', [WargaController::class, 'map'])->name('warga.map');

    Route::middleware('role:superadmin')->group(function () {
        Route::resource('users', UserController::class)->except('show');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});







require __DIR__ . '/auth.php';
