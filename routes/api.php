<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(BarangController::class)->group(function () {
    Route::get('/barang', 'index');
    Route::post('/barang/add', 'store');
    Route::put('/barang/{id}/update', 'update');
    Route::delete('/barang/{id}/delete', 'destroy');
});

Route::controller((BarangMasukController::class))->group(function () {
    Route::get('/barang-masuk', 'index');
    Route::post('/barang-masuk/add', 'store');
});
