<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PeminjamanSiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get(
//    '/',
//    function () {
//        return view('welcome');
//    }
//);

Route::match(['post', 'get'], '/', [AuthController::class, 'loginAdmin']);
Route::get('/logout',[AuthController::class,'logoutAdmin']);
Route::post('/register', [AuthController::class, 'register']);

Route::prefix('/admin')->middleware([AdminMiddleware::class])->group(
    function () {
        Route::get('/',[DashboardController::class, 'index']);

        Route::prefix('/barang')->group(
            function () {
                Route::match(['post', 'get'], '/', [BarangController::class, 'viewAllBarang']);
                Route::post('/delete/{id}', [BarangController::class, 'destroy']);
            }
        );

        Route::prefix('/guru')->group(
            function () {
                Route::get('/', [GuruController::class, 'index']);
                Route::get('/get-guru', [GuruController::class, 'getGuru']);
                Route::post('/delete/{id}', [GuruController::class, 'destroy']);
            }
        );

        Route::get('/siswa', [SiswaController::class, 'index']);

        Route::match(['post', 'get'], '/mapel', [MapelController::class, 'index']);

        Route::prefix('/laporanpinjaman')->group(
            function () {
                Route::get('/', [PeminjamanSiswaController::class, 'index']);
                Route::post('/', [PeminjamanSiswaController::class, 'konfirmasi']);
            }
        );

        Route::get('/history-pinjamam', [PeminjamanSiswaController::class, 'history']);

    }
);



