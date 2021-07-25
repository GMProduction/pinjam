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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/admin', function () {
    return view('admin/dashboard');
});

Route::get('/admin/barang', function () {
    return view('admin/barang/barang');
});

Route::get('/admin/guru', function () {
    return view('admin/guru/guru');
});

Route::post('/register',[AuthController::class,'register']);

Route::get('/barang', [BarangController::class, 'index']);
Route::post('/barang', [BarangController::class, 'createProduct']);
