<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\phantoms\phConsignacionesController;
use App\Http\Controllers\Admin\UserController;

Route::resource('/admin/users', UserController::class)->only(['index','edit','update'])->names('admin.users');

Route::get('/', [phConsignacionesController::class, 'index'])->middleware('auth:sanctum')->name('dashboard');
Route::post('/', [phConsignacionesController::class, 'store'])->name('guardar');
Route::get('create', [phConsignacionesController::class, 'create'])->name('crear');
Route::get('/{consignacion}', [phConsignacionesController::class, 'show'])->name('mostrar');
Route::get('/editar/{consignacion}', [phConsignacionesController::class, 'edit'])->name('editar');
Route::put('/actualizar/{consignaciones}', [phConsignacionesController::class, 'update'])->name('actualizar');
Route::delete('/{consignacion}', [phConsignacionesController::class, 'destroy'])->name('consignaciones.destroy');
// Route::view('/about', 'consignaciones.index')->name('about');

// Control de administradores