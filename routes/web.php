<?php

use Illuminate\Support\Facades\Route;
use App\Http\Requests\StorePostRequest;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\TransaksiCarController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware('role:admin')->get('/mobil', function () {
    return view('mobil/index');
})->name('mobil');

Route::middleware('role:admin')->group(function () {
    Route::resource('/mobil', MobilController::class);

    Route::resource('/roles', RoleController::class);

    Route::get('/laporan/trs', [LaporanController::class, 'transaksi']);
    Route::get('/laporan/trs/pdf', [LaporanController::class, 'transaksiPdf']);
    Route::get('/laporan/trs/excel', [LaporanController::class, 'transaksiExcel']);

    Route::get('/laporan/buku', [LaporanController::class, 'buku']);
    Route::get('/laporan/buku/pdf', [LaporanController::class, 'bukuPdf']);
    Route::get('/laporan/buku/excel', [LaporanController::class, 'bukuExcel']);
});

Route::resource('/sewa', TransaksiCarController::class)->middleware('role:anggota');

