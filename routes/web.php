<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\phantoms\phConsignacionesController;
use App\Http\Controllers\ConsignacionController;


Route::get('/', [phConsignacionesController::class, 'index'])->middleware('auth:sanctum')->name('dashboard');
// Route::get('/', [phConsignacionesController::class, 'index'])->name('dashboard');
// Route::post('/', [ConsignacionController::class, 'store']);
Route::post('/', [phConsignacionesController::class, 'store'])->name('guardar');
Route::get('create', [phConsignacionesController::class, 'create'])->name('crear');
Route::get('/{consignacion}', [phConsignacionesController::class, 'show'])->name('mostrar');
Route::delete('/{consignacion}', [phConsignacionesController::class, 'destroy'])->name('consignaciones.destroy');
Route::view('/about', 'consignaciones.index')->name('about');