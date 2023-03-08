<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\KelasController;
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

Route::post('/registersiswa', [SiswaController::class, 'register']);
Route::post('/loginsiswa', [SiswaController::class, 'login']);
Route::post('/kelas', [KelasController::class, 'create']);
Route::post('/jurusan', [JurusanController::class, 'create']);
Route::post('/registerguru', [GuruController::class, 'register']);
Route::post('/loginguru', [GuruController::class, 'login']);
Route::post('/kandidat', [KandidatController::class, 'create']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logoutsiswa', [SiswaController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logoutguru', [GuruController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
