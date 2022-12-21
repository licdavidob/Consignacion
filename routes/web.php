<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\phantoms\phConsignacionesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

// Ruta para los administradores
Route::resource('/admin/users', UserController::class)->only(['index','edit','update'])->middleware(['auth:sanctum', 'can:admin.users.index'])->names('admin.users');
// Ruta para el crud de permisos 
Route::resource('admin/roles', RoleController::class)->middleware('auth:sanctum')->names('admin.roles');

// Control de las consignaciones
Route::get('/', [phConsignacionesController::class, 'index'])->middleware(['auth:sanctum','can:consignacion.index'])->name('dashboard');
Route::post('/', [phConsignacionesController::class, 'store'])->middleware(['auth:sanctum','can:consignacion.guardar'])->name('guardar');
Route::get('create', [phConsignacionesController::class, 'create'])->middleware(['auth:sanctum','can:consignacion.crear'])->name('crear');
Route::get('/{consignacion}', [phConsignacionesController::class, 'show'])->middleware(['auth:sanctum','can:consignacion.mostrar'])->name('mostrar');
Route::get('/editar/{consignacion}', [phConsignacionesController::class, 'edit'])->middleware(['auth:sanctum','can:consignacion.editar'])->name('editar');
Route::put('/actualizar/{consignaciones}', [phConsignacionesController::class, 'update'])->middleware(['auth:sanctum','can:consignacion.actualizar'])->name('actualizar');
Route::delete('/{consignacion}', [phConsignacionesController::class, 'destroy'])->middleware(['auth:sanctum','can:consignacion.destroy'])->name('consignaciones.destroy');

