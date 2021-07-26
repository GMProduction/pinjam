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


