<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ReporteController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta para mostrar la lista de sesiones
Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');

// Ruta para mostrar una sesión específica por su ID
Route::get('/sessions/{id}', 'SessionController@show')->name('sessions.show');

Route::get('/reporte', [ReporteController::class, 'index'])->name('reporte.index');
Route::post('/reporte/generar', [ReporteController::class, 'generarReporte'])->name('reporte.generar');

Route::resource('users', App\Http\Controllers\UserController::class);
