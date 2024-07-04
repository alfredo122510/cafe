<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\DashboardController;

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

Route::get('login', [AuthController::class, 'verFormularioLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('crear_usuario', [AuthController::class, 'crear_usuario'])->name('crear_usuario');
// Rutas del Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rutas de Entregas
Route::get('/dashboard/entregas', [DashboardController::class, 'entregas'])->name('dashboard.entregas');
Route::get('/dashboard/entregas/create', [DashboardController::class, 'createEntrega'])->name('dashboard.entregas.create');
Route::post('/dashboard/entregas', [DashboardController::class, 'storeEntrega'])->name('dashboard.entregas.store');

// Rutas de Compras
Route::get('/dashboard/compras', [DashboardController::class, 'compras'])->name('dashboard.compras');
Route::get('/dashboard/compras/create', [DashboardController::class, 'createCompra'])->name('dashboard.compras.create');
Route::post('/dashboard/compras', [DashboardController::class, 'storeCompra'])->name('dashboard.compras.store');

// Rutas de Productos
Route::get('/dashboard/productos', [DashboardController::class, 'productos'])->name('dashboard.productos');
Route::get('/dashboard/productos/create', [DashboardController::class, 'createProducto'])->name('dashboard.productos.create');
Route::post('/dashboard/productos', [DashboardController::class, 'storeProducto'])->name('dashboard.productos.store');

// Rutas de Cuentas Totales
Route::get('/dashboard/cuentas', [DashboardController::class, 'cuentas'])->name('dashboard.cuentas');
Route::get('/dashboard/cuentas/create', [DashboardController::class, 'createCuenta'])->name('dashboard.cuentas.create');
Route::post('/dashboard/cuentas', [DashboardController::class, 'storeCuenta'])->name('dashboard.cuentas.store');


Route::get('/get-cantidad-disponible', [DashboardController::class, 'getCantidadDisponible']);

Route::get('/dashboard/fin-de-mes', [DashboardController::class, 'calcularFinDeMes'])->name('dashboard.finDeMes');
