<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\EquipoUsuario;
use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login','register','me2']]);
        //$this->middleware('auth:api', ['except' => ['paginacionSupervisor']]);
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*  $usuarios=User::all();
        return response()->json($usuarios); */
        //$usuarios=User::where('name', 'LIKE', '%'.'Prof'.'%')->get();//Like Query
        $usuarios=User::where('name', 'Prof. Josiah Balistreri')->get();
        return response()->json($usuarios);
    }
    public function empleados()
    {
       /*  $usuarios=User::all();
        return response()->json($usuarios); */
        //$usuarios=User::where('name', 'LIKE', '%'.'Prof'.'%')->get();//Like Query
        $users = User::role(3)->get(); 
        return response()->json($users);
    }

    public function miEquipo(){
        $usuario=auth()->user();
        $idUsuario=$usuario['id'];
        
        /*
        $equipos=EquipoUsuario::where('user_id', $idUsuario)->get();
        $equiposDatos=[];
        foreach ($equipos as $equipo) {
            $nuevoEquipo=Equipo::with('usuarios')->find($equipo['equipo_id']);
            array_push($equiposDatos, $nuevoEquipo);
          }
        */
        $rol=$usuario->getRoleNames()[0];
        if($rol=="Supervisor"){
            $data=Equipo::with('usuarios')->where('supervisor_id', $idUsuario)->get();
        }
        else{
            $data=User::with('equipo')->find(14);
        }
        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginacion()
    {
        $usuarios=User::with('roles')->orderBy('id')->paginate(10);
        return response()->json($usuarios);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::with('roles', 'equipo')->find($id);
        return $user;
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file =$request->file('foto')->store('public/fotos');

        return response()->json($file);
    }
    // funcion para conocer la cantidad de usuarios 
    public function cantidadUsuario(){
        $cantidadUs=User::count();  
        return response()->json($cantidadUs);
        
        }
       

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
