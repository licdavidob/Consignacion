<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('usuario', [UserController::class, 'index'])->name("usuario.index");
Route::post('usuario', [UserController::class, 'store'])->name("usuario.store");

 Route::group(['middleware' => ["auth:sanctum"]], function () {
     Route::get('Usuario/{id}', [UserController::class, 'show']);
     Route::put('Usuario/{id}', [UserController::class, 'update']);
     Route::delete('Usuario/{id}', [UserController::class, 'destroy']);
 });
