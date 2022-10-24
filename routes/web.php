<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\phantoms\phConsignacionesController;


Route::get('/', [phConsignacionesController::class, 'index'])->middleware('auth:sanctum')->name('dashboard');
// Route::get('/', [phConsignacionesController::class, 'index'])->name('dashboard');
Route::view('/about', 'consignaciones.index')->name('about');