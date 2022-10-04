<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\EjemploController;

use App\Http\Controllers\PermisosController;


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
//         ('url', [controller, 'metodo'])
Route::post('area/store',[AreaController::class, 'store']);
Route::resource('areas',AreaController::class);

Route::post('ejemplo',[EjemploController::class, 'store']);
Route::resource('ejemplos', EjemploController::class);
//permisos
Route::get('usuarios/permisos', [PermisosController::class, 'index']);
Route::get('usuarios/permisos/{permiso}', [PermisosController::class, 'show']);
Route::post('usuarios/permisos',[PermisosController::class, 'store']);
Route::delete('usuarios/permisos/{permiso}',[PermisosController::class, 'destroy']);
Route::put('usuarios/permisos/{permiso}',[PermisosController::class, 'update']);
//Route::resource('permisos', PermisosController::class);
//
Route::get('me2',[AuthController::class, 'me2']);

Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::group(['middleware'=>'api'], function () {
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});
