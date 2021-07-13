<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',[AuthController::class,'register']);

Route::get('/barang', [BarangController::class, 'getAllProduct']);
Route::get('/barang/{id}', [BarangController::class, 'getProductById']);
Route::get('/barang/cari/{name}', [BarangController::class, 'getProductByName']);

Route::post('/barang/tambah', [BarangController::class, 'createProduct']);
Route::match(['put','patch'],'/barang/{id}', [BarangController::class, 'getProductById']);
Route::delete('/barang/{id}', [BarangController::class, 'destroy']);

//Route::resource('barang',BarangController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
