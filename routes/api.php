<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthApiController;

use App\Http\Controllers\Api\BarangControllerApi;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

Route::post('/pengembalian', [PengembalianController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
});



Route::post('/login', [AuthapiController::class, 'login']);


Route::apiResource('barang', BarangControllerApi::class);

// Ensure the ProductController exists in the specified namespace




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::middleware('auth:sanctum')->post('/logout', [AuthApiController::class, 'logoutApi']);
