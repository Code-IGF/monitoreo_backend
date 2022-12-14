<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use App\Models\SalaTrabajo;

class EquipoController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login','register','me2']]);
        //$this->middleware('auth:api', ['except' => ['paginacionSupervisor']]);
        //$this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function paginacion()
    {
        $areas=Equipo::orderBy('id')->paginate(10);
        return response()->json($areas);
    }
    public function paginacionSupervisor()
    {
        $areas=Equipo::with('usuarios', 'area')->orderBy('id')->paginate(10);
        return response()->json($areas);
    }

    
        

        // funcion para conocer los equipos por medio de area_id
    public function consultarEqupoXArea ($id_area) {
        $equiposA =Equipo::where('area_id', $id_area)->count();
        return response()->json($equiposA);

    }
    public function cantidaEquipos(){
        /* $cantidad=User::count();  
        return response()->json($cantidad); */
        //$equpos=Equipo::where('id_area', '2')->conut()

        $equipos=Equipo::with('usuarios')->get();
        $datos=[];
        foreach( $equipos as $equipo){
            $datoEquipo['id']=$equipo['id'];
            $datoEquipo['empleados']=count($equipo['usuarios']);
            array_push($datos, $datoEquipo);
        }
        return response()->json($datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supervisor=$request->user(); 
        if($supervisor->hasRole('Supervisor')){
            //Si el usuario tiene el rol de supervisor
            $validator = Validator::make($request->all(),
            [
                'nombre' => 'required',
                'descripcion' => 'required',
                'area_id' => 'required',
                'integrantes'=>'required'
            ]);
            if($validator->fails())
            {
                //Recuperando error
                $error['type']="error";
                $error['message'] = $validator->errors()->first();
                return response()->json($error);
            }
            //Si todos los datos existen
            $equipo = request(['nombre','descripcion', 'area_id']);
            $equipo['supervisor_id']=$request->user()->id; 
            $equipo=Equipo::create($equipo);
            $integrantes=$request['integrantes'];
            //Creando configuracion
            $sala["hora_entrada"]="08:00:00";
            $sala["hora_salida"]="16:00:00";
            $sala["intervalo_conexion"]="00:05:00";
            $sala["equipos_id"]=$equipo["id"];
            $sala=SalaTrabajo::create($sala);

            foreach ($integrantes as &$integrante) {
                $integrante = $integrante['id'];
            }

            $equipo->usuarios()->sync($integrantes);
            return $integrantes;
        }
        //Si no tiene el rol necesario genera un error 401
        //En el frontend redirege al usuario al login
        return response()->json("Verificar Usuario", 401);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Equipo $equipo)
    {
        $data['equipo']=$equipo;
        $data['empleados']=$equipo->usuarios()->get();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipo $equipo)
    {
        //Si el usuario tiene el rol de supervisor
        $validator = Validator::make($request->all(),
        [
            'nombre' => 'required',
            'descripcion' => 'required',
            'area_id' => 'required',
            'integrantes'=>'required'
        ]);
        if($validator->fails())
        {
            //Recuperando error
            $error['type']="error";
            $error['message'] = $validator->errors()->first();
            return response()->json($error);
        }

        if($equipo['supervisor_id']== $request->user()->id){
            //Actualizando
            $equipo['nombre']=$request['nombre'];
            $equipo['descripcion']=$request['descripcion'];
            $equipo['area_id']=$request['area_id'];
            $integrantes=$request['integrantes'];
            foreach ($integrantes as &$integrante) {
                $integrante = $integrante['id'];
            }
            $equipo->save();
            $equipo->usuarios()->sync($integrantes);
        }
        else{
            $error['type']="error";
            $error['message'] = "Solo puede editar los equipos que supervisa.";
            return response()->json($error);
        }

        return $equipo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Equipo $equipo)
    {
        if($equipo['supervisor_id']== $request->user()->id){
            $equipo->delete();
            return Response()->json("success");
        }
        return Response()->json("Solo puede eliminar sus equipos");   

    }
}
