<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\Cajas\CajaController;
use App\Http\Controllers\Tenant\ExportExcelController;
use App\Http\Controllers\Tenant\ImportExcelController;
use App\Http\Controllers\Tenant\ModeloExcelController;
use App\Http\Controllers\Tenant\Cajas\EgresoController;
use App\Http\Controllers\Tenant\Almacen\MarcaController;
use App\Http\Controllers\Tenant\Almacen\AlmacenController;
use App\Http\Controllers\Tenant\Almacen\ProductoController;
use App\Http\Controllers\Tenant\Almacen\ServicioController;
use App\Http\Controllers\Tenant\Cajas\MovimientoController;
use App\Http\Controllers\Tenant\Almacen\CategoriaController;
use App\Http\Controllers\Tenant\Almacen\NotaSalidaController;
use App\Http\Controllers\Tenant\Almacen\NotaIngresoController;
use App\Http\Controllers\Tenant\Maintenance\SportController;
use App\Http\Controllers\Tenant\Configuration\FieldController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('tenant.dashboard');

    Route::group(['prefix' => 'cajas'], function () {

        /** RUTA PARA CAJA */
        Route::controller(CajaController::class)->group(function () {
            Route::get("caja/index", 'index')->name("tenant.caja.index");
            Route::post("caja/store", 'store')->name("tenant.caja.store");
            Route::put("caja/update", 'update')->name("tenant.caja.update");
        });

        /** RUTA PARA MOVIMIENTO CAJA */
        Route::controller(MovimientoController::class)->group(function () {
            Route::get("movimientos/index", 'index')->name("tenant.caja.movimientos.index");
        });

        /** RUTA PARA EGRESOS */
        Route::controller(EgresoController::class)->group(function () {
            Route::get("egresos/index", 'index')->name("tenant.caja.egreso.index");
        });
    });

    Route::group(['prefix' => 'almacen'], function () {

        /** RUTA PARA ALMAACENES */
        Route::controller(AlmacenController::class)->group(function () {
            Route::get("almacenes/index", 'index')->name("tenant.almacen.almacenes.index");
            Route::post("almacenes/store", 'store')->name("tenant.almacen.almacenes.store");
            Route::put("almacenes/update", 'update')->name("tenant.almacen.almacenes.update");
            Route::put("almacenes/delete/{id}", 'delete')->name("tenant.almacen.almacenes.delete");
        });

        /** RUTA PARA CATEGORIAS */
        Route::controller(CategoriaController::class)->group(function () {
            Route::get("categorias/index", 'index')->name("tenant.almacen.categorias.index");
            Route::post("categorias/store", 'store')->name("tenant.almacen.categorias.store");
            Route::put("categorias/update/{categoria}", 'update')->name("tenant.almacen.categorias.update");
            Route::put("categorias/delete/{id}", 'delete')->name("tenant.almacen.categorias.delete");
        });

        /** RUTA PARA MARCAS */
        Route::controller(MarcaController::class)->group(function () {
            Route::get("marcas/index", 'index')->name("tenant.almacen.marcas.index");
            Route::post("marcas/store", 'store')->name("tenant.almacen.marcas.store");
            Route::put("marcas/update/{marca}", 'update')->name("tenant.almacen.marcas.update");
            Route::put("marcas/delete/{id}", 'delete')->name("tenant.almacen.marcas.delete");
        });

        /** RUTA PARA PRODUCTOS */
        Route::controller(ProductoController::class)->group(function () {
            Route::get("productos/index", 'index')->name("tenant.almacen.productos.index");
            Route::get("productos/create", 'create')->name("tenant.almacen.productos.create");
            Route::get("productos/{id}/edit", 'edit')->name("tenant.almacen.productos.edit");
            Route::post("productos/store", 'store')->name("tenant.almacen.productos.store");
            Route::put("productos/update/{producto}", 'update')->name("tenant.almacen.productos.update");
            Route::put("productos/updateigv/{producto}", 'updateIgv')->name("tenant.almacen.productos.updateigv");
            Route::put("productos/delete/{id}", 'delete')->name("tenant.almacen.productos.delete");
            Route::get("productos/getProductos", 'getProductos')->name("tenant.almacen.productos.getProductos");
        });

        /** RUTA PARA SERVICIOS */
        Route::controller(ServicioController::class)->group(function () {
            Route::get("servicios/index", 'index')->name("tenant.almacen.servicios.index");
            Route::post("servicios/store", 'store')->name("tenant.almacen.servicios.store");
            Route::put("servicios/update/{servicio}", 'update')->name("tenant.almacen.servicios.update");
            Route::put("servicios/delete/{id}", 'delete')->name("tenant.almacen.servicios.delete");
        });

        /** RUTA PARA NOTAS DE INGRESO */
        Route::controller(NotaIngresoController::class)->group(function () {
            Route::get("nota-ingreso/index", 'index')->name("tenant.almacen.notaingreso.index");
            Route::get("nota-ingreso/create", 'create')->name("tenant.almacen.notaingreso.create");
            Route::post("nota-ingreso/store", 'store')->name("tenant.almacen.notaingreso.store");
            Route::get("nota-ingreso/{nota}/edit", 'edit')->name("tenant.almacen.notaingreso.edit");
            Route::put("nota-ingreso/update/{servicio}", 'update')->name("tenant.almacen.notaingreso.update");
            Route::put("nota-ingreso/delete/{id}", 'delete')->name("tenant.almacen.notaingreso.delete");
        });

        /** RUTA PARA NOTAS DE SALIDA */
        Route::controller(NotaSalidaController::class)->group(function () {
            Route::get("nota-salida/index", 'index')->name("tenant.almacen.notasalida.index");
            Route::get("nota-salida/create", 'create')->name("tenant.almacen.notasalida.create");
            Route::post("nota-salida/store", 'store')->name("tenant.almacen.notasalida.store");
            Route::put("nota-salida/update/{servicio}", 'update')->name("tenant.almacen.notasalida.update");
            Route::put("nota-salida/delete/{id}", 'delete')->name("tenant.almacen.notasalida.delete");
        });
    });
    Route::group(['prefix' => 'modelo-excel'], function () {
        Route::controller(ModeloExcelController::class)->group(function () {
            Route::get("categorias", 'categoria')->name("modeloexcel.categoria");
            Route::get("marcas", 'marca')->name("modeloexcel.marca");
            Route::get("productos", 'producto')->name("modeloexcel.producto");
        });
    });
    Route::group(['prefix' => 'import-excel'], function () {
        Route::controller(ImportExcelController::class)->group(function () {
            Route::post("categorias", 'categoria')->name("importexcel.categoria");
            Route::post("marcas", 'marca')->name("importexcel.marca");
            Route::post("productos", 'producto')->name("importexcel.producto");
        });
    });
    Route::group(['prefix' => 'export-excel'], function () {
        Route::controller(ExportExcelController::class)->group(function () {
            Route::get("productos", 'productos')->name("exportexcel.producto");
        });
    });

    /* CC1 Mantenimiento - BEGIN */
    Route::group(['prefix' => 'maintenance'], function () {
        // Deporte
        Route::controller(SportController::class)->group(function () {
            Route::get("sports/index", 'index')->name("tenant.maintenance.sports.index");
            Route::post("sports/store", 'store')->name("tenant.maintenance.sports.store");
            Route::put("sports/update", 'update')->name("tenant.maintenance.sports.update");
            Route::put("sports/delete/{id}", 'delete')->name("tenant.maintenance.sports.delete");
            Route::get("sports/active", 'getSportsActive')->name("tenant.maintenance.sports.active");
        });
    });
    /* CC1 Mantenimiento - END */

    Route::group(['prefix' => 'configuration'], function () {
        // Campo
        Route::controller(FieldController::class)->group(function () {
            Route::get("fields/index", 'index')->name("tenant.configuration.fields.index");
            Route::post("fields/store", 'store')->name("tenant.configuration.fields.store");
            Route::put("fields/update", 'update')->name("tenant.configuration.fields.update");
            Route::put("fields/delete/{id}", 'delete')->name("tenant.configuration.fields.delete");
        });
    });
});
