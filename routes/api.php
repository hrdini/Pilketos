<?php

use App\Http\Controllers\AdminController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function(){
    //ADMIN AUTH ----------------------
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/edit/{id}', [AdminController::class, 'update']);
    Route::get('/del/{id}', [AdminController::class, 'destroy']);
    Route::get('/show/{id}', [AdminController::class, 'show']);
    Route::get('/index', [AdminController::class, 'index']);
    Route::post('/register', [AdminController::class, 'register']);
    Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [AdminController::class, 'logout']);
    });

Route::prefix('kandidat')->group(function(){
    //ADMIN KANDIDAT
    Route::post('/edit/{id}', [KandidatController::class, 'update']);
    Route::get('/del/{id}', [KandidatController::class, 'destroy']);
    Route::get('/show/{id}', [KandidatController::class, 'show']);
    Route::get('/index', [KandidatController::class, 'index']);
    Route::post('/register', [KandidatController::class, 'register']);
});

Route::prefix('jurusan')->group(function(){
    //JURUSAN
    Route::post('/edit/{id}', [JurusanController::class, 'update']);
    Route::get('/del/{id}', [JurusanController::class, 'destroy']);
    Route::get('/show/{id}', [JurusanController::class, 'show']);
    Route::get('/index', [JurusanController::class, 'index']);
    Route::post('/register', [JurusanController::class, 'register']);
});

Route::prefix('kelas')->group(function(){
    //KELAS
    Route::post('/edit/{id}', [KelasController::class, 'update']);
    Route::get('/del/{id}', [KelasController::class, 'destroy']);
    Route::get('/show/{id}', [KelasController::class, 'show']);
    Route::get('/index', [KelasController::class, 'index']);
    Route::post('/register', [KelasController::class, 'register']);
});

});


Route::prefix('guru')->group(function(){
    //GURU AUTH ----------------------
    Route::post('/login', [GuruController::class, 'login']);
    Route::post('/edit/{id}', [GuruController::class, 'update']);
    Route::get('/del/{id}', [GuruController::class, 'destroy']);
    Route::get('/show/{id}', [GuruController::class, 'show']);
    Route::get('/index', [GuruController::class, 'index']);
    Route::post('/register', [GuruController::class, 'register']);
    Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [GuruController::class, 'logout']);
    });
});

Route::prefix('siswa')->group(function(){
    //SISWA AUTH ----------------------
    Route::post('/login', [SiswaController::class, 'login']);
    Route::post('/edit/{id}', [SiswaController::class, 'update']);
    Route::get('/del/{id}', [SiswaController::class, 'destroy']);
    Route::get('/show/{id}', [SiswaController::class, 'show']);
    Route::get('/index', [SiswaController::class, 'index']);
    Route::post('/register', [SiswaController::class, 'register']);
    Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [SiswaController::class, 'logout']);
    });

Route::prefix('jurusan')->group(function(){
    //JURUSAN
    Route::post('/edit/{id}', [JurusanController::class, 'update']);
    Route::get('/del/{id}', [JurusanController::class, 'destroy']);
    Route::get('/show/{id}', [JurusanController::class, 'show']);
    Route::get('/index', [JurusanController::class, 'index']);
    Route::post('/register', [JurusanController::class, 'register']);
    });
    
Route::prefix('kelas')->group(function(){
    //KELAS
    Route::post('/edit/{id}', [KelasController::class, 'update']);
    Route::get('/del/{id}', [KelasController::class, 'destroy']);
    Route::get('/show/{id}', [KelasController::class, 'show']);
    Route::get('/index', [KelasController::class, 'index']);
    Route::post('/register', [KelasController::class, 'register']);
    });
});
