<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\UsuarioController;

use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RoleController;
use App\Events\NewMessage;
use App\Events\NuevoLog;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SalaTrabajoController;

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
Route::get('equipos/paginate',[EquipoController::class, 'paginacionSupervisor']);
Route::get('equipos/Area/{id_area}', [EquipoController::class, 'consultarEqupoXArea']);
Route::get('equipos/cantidad', [EquipoController::class, 'cantidaEquipos']);
Route::resource('equipos',EquipoController::class);

//permisos
Route::get('usuarios/permisos', [PermisosController::class, 'index']);
Route::get('usuarios/permisos/{permiso}', [PermisosController::class, 'show']);
Route::post('usuarios/permisos',[PermisosController::class, 'store']);
Route::delete('usuarios/permisos/{permiso}',[PermisosController::class, 'destroy']);
Route::put('usuarios/permisos/{permiso}',[PermisosController::class, 'update']);
//Route::resource('permisos', PermisosController::class);
Route::get('usuarios/empleados', [UsuarioController::class, 'empleados']);
Route::get('usuarios', [UsuarioController::class, 'index']);
Route::get('usuarios/paginacion', [UsuarioController::class, 'paginacion']);
Route::get('usuarios/{id}', [UsuarioController::class, 'show']);

Route::post('usuarios', [UsuarioController::class, 'store']);
//  para conocer la cantidad de usuarios 
Route::get('usuarios/User',[UsuarioController::class, 'cantidadUsuario']);

//ControllerUsuarios (Para ver todos y para paginar)

Route::get('usuario/miEquipo',[UsuarioController::class, 'miEquipo']);

//Eliminar usuario
Route::delete('user/delete/{user}', [AuthController::class, 'eliminar']);
//editar Usuario (se ocupa post porque laravel no detecta el request de un FormData)
Route::post('user/edit/{user}',[AuthController::class, 'update']);
//Modificar Perfil
Route::post('me/edit',[AuthController::class, 'ActualizarPerfil']);


Route::post('ejemploRa20073',[EjemploRa20073Controller::class, 'store']);
Route::resource('ejemploRa20073',EjemploRa20073Controller::class);



Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::group(['middleware'=>'api'], function () {
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});
//ruta para los mensajes
Route::get('mensajes',[MensajeController::class, 'paginacion']);
Route::post('mensajes',[MensajeController::class, 'store']);
Route::get('mensajes/{mensaje}',[MensajeController::class, 'show']);
Route::delete('mensajes/{mensaje}',[MensajeController::class, 'destroy']);

Route::post("sala/{salaTrabajo}",[SalaTrabajoController::class, "update"]);

//Ruta para socket de prueba
Route::post('new-message', function (Request $request) {
    event(new NewMessage($request->message));
    return 'ok';
});
Route::post('new-log', function (Request $request) {
    event(new NuevoLog($request->tipo, $request->nombreChannel));
    return 'ok';
});

//Funciones del controlador log
Route::post('log',[LogController::class, 'store']);
