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
        Route::prefix('/siswa')->group(function (){
            Route::match(['get', 'post'], '/', [APISiswaController::class, 'index']);
            Route::post('/update-image',[APISiswaController::class,'updateProfileImage']);
        });

        Route::prefix('/guru')->group(function (){
            Route::match(['get', 'post'], '/', [APIGuruController::class, 'index']);
            Route::post('/update-image',[APIGuruController::class,'updateProfileImage']);
        });

        Route::prefix('/pinjam')->group(function (){
            Route::get( '/', [APIPeminjamanSiswaController::class, 'index']);
            Route::post( '/', [APIPeminjamanSiswaController::class, 'store']);
            Route::get( '/{id}', [APIPeminjamanSiswaController::class, 'show']);
        });

        Route::prefix('/pinjam-guru')->group(function (){
            Route::get( '/', [APIPinjamGuruController::class, 'index']);
            Route::get( '/history', [APIPinjamGuruController::class, 'history']);
            Route::get( '/{id}', [APIPinjamGuruController::class, 'show']);
            Route::post( '/{id}', [APIPinjamGuruController::class, 'update']);
        });


    }
);
