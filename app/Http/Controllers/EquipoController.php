<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Contracts\Providers\Auth;

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
        $this->middleware('auth:api');
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
        $areas=Equipo::orderBy('id')->paginate(10);
        return response()->json($areas);
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
    public function show(Equipo $equipo)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        
    }
}
