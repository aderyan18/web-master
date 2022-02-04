<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\DataPoliController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataDokterController;
use App\Http\Controllers\DataPasienController;
use App\Http\Controllers\DataObatController;
use App\Http\Controllers\DataApotekerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\ReservasiController;

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
    return redirect('login');
});
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'show']);
});

Route::group(['middleware' => ['auth', 'cekrole:admin,super admin']], function () {
    Route::get('datauser', [DataUserController::class, 'show']);
    Route::post('datauser', [DataUserController::class, 'create']);
    Route::get('datauser/{id}/edit', [DataUserController::class, 'edit']);
    Route::patch('datauser/update', [DataUserController::class, 'update']);
    Route::delete('datauser/{id}/hapus', [DataUserController::class, 'delete']);
    Route::patch('datauser/{id}/reset', [DataUserController::class, 'reset']);

    Route::get('datadokter', [DataDokterController::class, 'show']);
    Route::post('datadokter', [DataDokterController::class, 'create']);
    Route::get('datadokter/{id}/edit', [DataDokterController::class, 'edit']);
    Route::patch('datadokter/update', [DataDokterController::class, 'update']);
    Route::delete('datadokter/{id}/hapus', [DataDokterController::class, 'delete']);

    Route::get('datapoli', [DataPoliController::class, 'show']);
    Route::post('datapoli', [DataPoliController::class, 'create']);
    Route::get('datapoli/{id}/edit', [DataPoliController::class, 'edit']);
    Route::patch('datapoli/update', [DataPoliController::class, 'update']);
    Route::delete('datapoli/{id}/hapus', [DataPoliController::class, 'delete']);

    Route::get('dataapoteker', [DataApotekerController::class, 'show']);
    Route::post('dataapoteker', [DataApotekerController::class, 'create']);
    Route::get('dataapoteker/{id}/edit', [DataApotekerController::class, 'edit']);
    Route::patch('dataapoteker/update', [DataApotekerController::class, 'update']);
    Route::delete('dataapoteker/{id}/hapus', [DataApotekerController::class, 'delete']);
});
Route::group(['middleware' => ['auth', 'cekrole:admin,dokter,super admin']], function () {
    Route::get('datapasien', [DataPasienController::class, 'show']);
    Route::post('datapasien', [DataPasienController::class, 'create']);
    Route::get('datapasien/{id}/edit', [DataPasienController::class, 'edit']);
    Route::get('datapasien/{id}/kartu', [DataPasienController::class, 'kartu']);
    Route::patch('datapasien/update', [DataPasienController::class, 'update']);
    Route::delete('datapasien/{id}/hapus', [DataPasienController::class, 'delete']);
    Route::get('datapasien/{id}/pdf', [DataPasienController::class, 'cetak_PDF']);

    Route::get('daftarreservasi', [ReservasiController::class, 'show']);
    Route::post('daftarreservasi', [ReservasiController::class, 'create']);
    Route::get('daftarreservasi/{id}/edit', [ReservasiController::class, 'edit']);
    Route::patch('daftarreservasi/update', [ReservasiController::class, 'update']);
    Route::delete('daftarreservasi/{id}/hapus', [ReservasiController::class, 'delete']);

    Route::get('pemeriksaan/{id}/', [PemeriksaanController::class, 'index']);
    Route::post('pemeriksaan', [PemeriksaanController::class, 'pemeriksaan']);
    Route::get('riwayatperiksa', [PemeriksaanController::class, 'riwayat']);
    Route::get('riwayat/{id}', [PemeriksaanController::class, 'riwayatpasien']);
});

Route::group(['middleware' => ['auth', 'cekrole:apoteker,super admin,admin']], function () {
    Route::get('dataobat', [DataObatController::class, 'show']);
    Route::post('dataobat', [DataObatController::class, 'create']);
    Route::get('dataobat/{id}/edit', [DataObatController::class, 'edit']);
    Route::patch('dataobat/update', [DataObatController::class, 'update']);
    Route::delete('dataobat/{id}/hapus', [DataObatController::class, 'delete']);

    Route::get('datapenjualan', [KasirController::class, 'penjualan']);
    Route::get('kasir', [KasirController::class, 'index']);
    Route::post('kasir', [KasirController::class, 'selesai']);
    Route::get('kasir/{id}/stock', [KasirController::class, 'stock']);
    Route::post('kasir/temporary', [KasirController::class, 'temporary']);
    Route::get('kasir/{id}/edit', [KasirController::class, 'edit']);
    Route::patch('kasir/update', [KasirController::class, 'update']);
    Route::delete('kasir/{id}/hapus', [KasirController::class, 'hapus']);
    Route::delete('kasir/batal', [KasirController::class, 'batal']);
});


Route::post('coba', [ModalController::class, 'coba']);
Route::get('tes', [ModalController::class, 'tes']);
Route::get('admin', [ModalController::class, 'tess']);

Route::post('proseslogin', [LoginController::class, 'proseslogin']);
