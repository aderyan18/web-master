<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PoliController;
use App\Http\Controllers\api\PasienController;
use App\Http\Controllers\api\ReservasiController;
use App\Http\Controllers\api\RiwayatController;
use App\Http\Controllers\api\StatusController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\PasswordController;

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
//Route::get('datapasien', [DataPasienController::class, 'show']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//login
Route::post('login', [LoginController::class, 'cek']);

//daftar pasien
Route::post('pasien', [PasienController::class, 'store']);
//edit data
Route::get('pasien/{id}/edit', [PasienController::class, 'edit']);
Route::patch('pasien/update', [PasienController::class, 'update']);

//data poli
Route::get('poli', [PoliController::class, 'index']);

//riwayatpemeriksaan
Route::get('riwayat/{id}', [RiwayatController::class, 'index']);

//reservasi
//cek status reservasi
Route::get('status', [StatusController::class, 'index']);
//menampilkan reservasi yang dilakukan
Route::get('reservasi/{id}', [ReservasiController::class, 'index']);
//melakukan reservasi
Route::post('reservasi', [ReservasiController::class, 'store']);
Route::post('cancel-reservasi/{id}', [ReservasiController::class, 'batal']);

Route::post('cekreservasi', [ReservasiController::class, 'cek']);
//ganti password
Route::post('password/{id}', [PasswordController::class, 'change']);
