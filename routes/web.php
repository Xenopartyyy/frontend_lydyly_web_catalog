<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MainDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [MainController::class, 'index']);

// Register
Route::get('/hidden-pathway-9348-akun2', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/hidden-pathway-9348-akun2', [RegisterController::class, 'register'])->name('register');

// Login & Logout
Route::get('/login/akun/lydyly2', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/akun/lydyly2', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::middleware('auth.token')->group(function () {

    Route::prefix('dashboard')->group(function () {

        // Dashboard Home
        Route::get('/lydyly2', [MainDashboardController::class, 'index']);


        // Produk (CRUD)
        Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::post('produk', [ProdukController::class, 'store'])->name('produk.store');
        Route::get('produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::post('produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
        Route::get('produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
        Route::delete('produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    });
});
