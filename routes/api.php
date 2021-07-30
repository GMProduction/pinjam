<?php

use App\Http\Controllers\APIBarangController;
use App\Http\Controllers\APIGuruController;
use App\Http\Controllers\APIMapelController;
use App\Http\Controllers\APISiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MapelGuruController;
use App\Http\Controllers\APIPeminjamanSiswaController;
use App\Http\Controllers\APIPinjamGuruController;
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
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);
Route::get('/barang', [APIBarangController::class, 'getAllProduct']);
Route::get('/barang/{id}', [APIBarangController::class, 'getProductById']);
//Route::get('/barang/cari/nama', [APIBarangController::class, 'getProductByName']);

//Route::resource('barang',BarangController::class);

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::resource('mapel', APIMapelController::class);
Route::resource('mapel-guru', MapelGuruController::class);

Route::group(
    ['middleware' => ['auth:sanctum']],
    function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::match(['get', 'post'], '/siswa', [APISiswaController::class, 'index']);
        Route::match(['get', 'post'], '/guru', [APIGuruController::class, 'index']);
        Route::get( '/pinjam', [APIPeminjamanSiswaController::class, 'index']);
        Route::post( '/pinjam', [APIPeminjamanSiswaController::class, 'store']);
        Route::get( '/pinjam/{id}', [APIPeminjamanSiswaController::class, 'show']);
        Route::get( '/pinjam-guru', [APIPinjamGuruController::class, 'index']);
        Route::get( '/pinjam-guru/{id}', [APIPinjamGuruController::class, 'show']);
        Route::post( '/pinjam-guru/{id}', [APIPinjamGuruController::class, 'update']);
    }
);
