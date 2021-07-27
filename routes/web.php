<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
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

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Route::match(['post', 'get'], '/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::prefix('/admin')->group(
    function () {
        Route::get(
            '/',
            function () {
                return view('admin/dashboard');
            }
        );

        Route::prefix('/barang')->group(function (){
            Route::match(['post','get'],'/', [BarangController::class, 'viewAllBarang']);
            Route::post('/delete/{id}', [BarangController::class, 'destroy']);
        });

        Route::get(
            '/guru',
            function () {
                return view('admin/guru/guru');
            }
        );

        Route::get(
            '/siswa',
            function () {
                return view('admin/siswa/siswa');
            }
        );
    }
);


<<<<<<< HEAD
=======
Route::get('/admin', function () {
    return view('admin/dashboard');
});

Route::get('/admin/barang', function () {
    return view('admin/barang/barang');
});

Route::get('/admin/guru', function () {
    return view('admin/guru/guru');
});

Route::get('/admin/siswa', function () {
    return view('admin/siswa/siswa');
});

Route::get('/admin/mapel', function () {
    return view('admin/mapel/mapel');
});

Route::get('/admin/laporanpinjaman', function () {
    return view('admin/laporan/pinjamalat');
});


Route::post('/register',[AuthController::class,'register']);

Route::get('/barang', [BarangController::class, 'index']);
Route::post('/barang', [BarangController::class, 'createProduct']);
>>>>>>> 6663f5c521c0bc685818d0de23503544a6ee30a3
