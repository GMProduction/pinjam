<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MapelGuruController;
use App\Http\Controllers\PeminjamanSiswaController;
use App\Http\Controllers\PinjamGuruController;
use App\Http\Controllers\SiswaController;
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

Route::post('/login',[AuthController::class,'login']);

Route::post('/register',[AuthController::class,'register']);
Route::get('/barang', [BarangController::class, 'getAllProduct']);
Route::get('/barang/{id}', [BarangController::class, 'getProductById']);
Route::get('/barang/cari/nama', [BarangController::class, 'getProductByName']);


//Route::resource('barang',BarangController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('mapel', MapelController::class);
Route::resource('mapel-guru', MapelGuruController::class);

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::resource('siswa', SiswaController::class);
    Route::resource('pinjam', PeminjamanSiswaController::class);
    Route::resource('/pinjam-guru', PinjamGuruController::class);

});
