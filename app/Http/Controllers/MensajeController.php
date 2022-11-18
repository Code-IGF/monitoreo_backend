<?php

namespace App\Http\Controllers;


use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $mensaje=Mensaje::all();
        //return response()->json($mensaje);
    }

    public function paginacion(){
        $sala=Mensaje::orderBy('id')->paginate(10);
        return response()->json($sala);
    }


    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login','register','me2']]);
        //$this->middleware('auth:api', ['except' => ['paginacionSupervisor']]);
        $this->middleware('auth:api');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),
            [
                
                'sala_trabajo_id' => 'required',
                'texto'=>'required'
            ]);
            if($validator->fails())
            {
                //Recuperando error
                $error['type']="error";
                $error['message'] = $validator->errors()->first();
                return response()->json($error);
            }
        $mensaje=request(['sala_trabajo_id','texto']);

        $id_usuario=auth()->user()->id; 
        $mensaje['user_id']=$id_usuario;
        $mensaje=Mensaje::create($mensaje);
        return response()->json($mensaje);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function show(Mensaje $mensaje)
    {
        //
        
        return $mensaje;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensaje $mensaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensaje $mensaje)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensaje $mensaje)
    {
        //
        if($mensaje['user_id']== auth()->user()->id){
            $mensaje->delete();
            return Response()->json("success");
        }
        return Response()->json("Solo puede eliminar sus propio mensaje"); 
        //return Response()->json(auth()->user()->id);


    }
}
