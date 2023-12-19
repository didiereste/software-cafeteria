<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'showlogin'])->name('login');

Route::post('/ingresar', [AuthController::class, 'ingreso'])->name('ingreso');
Route::post('/registro',[UserController::class, 'registrar'])->name('registrar');
Route::get('/registrarse',[AuthController::class, 'showregistro'])->name('registrarse');


Route::middleware(['auth'])->group(function () {
    Route::get('/home',[HomeController::class, 'home'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/productos', ProductoController::class);
    Route::resource('/usuarios', UserController::class);
    Route::get('/venta', [VentaController::class, 'venta'])->name('venta');
    Route::post('/vender', [VentaController::class, 'vender'])->name('vender');
    Route::get('/consulta',[ConsultaController::class, 'consulta'])->name('consulta');
});


