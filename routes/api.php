<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\UsuarioController;

use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RoleController;

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
Route::get('areas/paginacion', [AreaController::class, 'paginacion']);
Route::resource('areas',AreaController::class);
//Roles
Route::resource('rol',RoleController::class);

//Equipos
Route::get('equipos/paginate',[EquipoController::class, 'paginacion']);

//permisos
Route::get('usuarios/permisos', [PermisosController::class, 'index']);
Route::get('usuarios/permisos/{permiso}', [PermisosController::class, 'show']);
Route::post('usuarios/permisos',[PermisosController::class, 'store']);
Route::delete('usuarios/permisos/{permiso}',[PermisosController::class, 'destroy']);
Route::put('usuarios/permisos/{permiso}',[PermisosController::class, 'update']);
//Route::resource('permisos', PermisosController::class);
Route::get('usuarios', [UsuarioController::class, 'index']);
Route::get('usuarios/paginacion', [UsuarioController::class, 'paginacion']);
Route::post('usuarios', [UsuarioController::class, 'store']);
//ControllerUsuarios (Para ver todos y para paginar)

Route::get('me2',[AuthController::class, 'me2']);

//Eliminar usuario
Route::delete('user/delete/{user}', [AuthController::class, 'eliminar']);
//editar Usuario (se ocupa post porque laravel no detecta el request de un FormData)
Route::post('user/edit/{user}',[AuthController::class, 'update']);

Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::group(['middleware'=>'api'], function () {
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});
