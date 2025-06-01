<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PengembalianController;


Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::put('/pengembalian/{id}/update-status', [PengembalianController::class, 'updateStatus'])->name('pengembalian.updateStatus');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route untuk aplikasi web.
|--------------------------------------------------------------------------
*/

// Auth
Route::get('/', fn () => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register Admin
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Register User Biasa (Form dan Submit)
Route::get('/registeruser', [PenggunaController::class, 'showRegisterForm'])->name('register.user.form');
Route::post('/registeruser', [PenggunaController::class, 'register'])->name('register.user');

// Dashboard
Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');

// Barang CRUD
Route::prefix('barang')->name('barang.')->group(function () {
    Route::get('/', [BarangController::class, 'index'])->name('index');
    Route::get('/create', [BarangController::class, 'create'])->name('create');
    Route::post('/', [BarangController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('edit');
    Route::put('/{id}', [BarangController::class, 'update'])->name('update');
    Route::delete('/{id}', [BarangController::class, 'destroy'])->name('destroy');
});

// Kategori Barang CRUD
Route::prefix('kategori')->name('kategori.')->group(function () {
    Route::get('/', [KategoriBarangController::class, 'index'])->name('index');
    Route::get('/create', [KategoriBarangController::class, 'create'])->name('create');
    Route::post('/', [KategoriBarangController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [KategoriBarangController::class, 'edit'])->name('edit');
    Route::put('/{id}', [KategoriBarangController::class, 'update'])->name('update');
    Route::delete('/{id}', [KategoriBarangController::class, 'destroy'])->name('destroy');
});

// Pendataan Barang + Kategori
Route::get('/index', [BarangController::class, 'data'])->name('index');

// Peminjaman
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman');
Route::put('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
Route::put('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

// User
Route::get('/users', [AuthController::class, 'showUsers'])->name('user');
