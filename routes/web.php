<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtController;
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

// admin
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    route::resource('rt', RtController::class)
    ->only(['index','create','store','edit','update','destroy']);
    
});

// user
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});




// akses user
Route::middleware('auth')->group(function () {


    Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');


    Route::middleware('role:admin')->group(function () {
        Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
        Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');

        Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
        Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
        Route::delete('/warga/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');
    });


    Route::get('/warga/{id}', [WargaController::class, 'show'])->name('warga.show');
    Route::get('/map/warga', [WargaController::class, 'map'])->name('warga.map');
});



require __DIR__ . '/auth.php';
