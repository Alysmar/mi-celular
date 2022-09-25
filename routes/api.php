<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;
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

Route::post('/productos', [ProductoController::class, 'store']);
Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/productos/{id}', [ProductoController::class, 'show']);

Route::post('/clientes', [ClienteController::class, 'store']);
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/{id}', [ClienteController::class, 'show']);

Route::post('/proveedores', [ProveedorController::class, 'store']);
Route::get('/proveedores', [ProveedorController::class, 'index']);
Route::get('/proveedores/{id}', [ProveedorController::class, 'show']);

Route::post('/ventas', [VentaController::class, 'store']);
Route::get('/ventas', [VentaController::class, 'index']);
Route::get('/ventas/{id}', [VentaController::class, 'show']);

/**GESTION DE INVENTARIOS */
Route::post('/inventarios', [InventarioController::class, 'store']);
Route::get('/inventarios', [InventarioController::class, 'index']);
Route::get('/inventarios/{id}', [InventarioController::class, 'show']);
Route::put('/inventarios/{id}', [InventarioController::class, 'update']);
Route::delete('/inventarios/{id}', [InventarioController::class, 'destroy']);

/**REPORTES */

//Estado de cuenta
Route::get('/estadocuenta/{fecha_desde}/{fecha_hasta}', [VentaController::class, 'estadocuenta']);

//Costo de inventario
Route::get('/costoinventario/{fecha_desde}/{fecha_hasta}', [InventarioController::class, 'costoinventario']);
