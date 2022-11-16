<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerConfiguracion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $configuracion = request(['id_configuracion','hora_entrada','hora_salida','intervalo_conexion']);
        Configuracion::create($configuracion);
        $validator = Validator::make($request->all(),
        [
            'id_configuracion' => 'required',
            'hora_entrada' => 'required',
            'hora_salida' => 'required',
            'intervalo_conexion' => 'required'
        ]);
        if($validator->fails()){
            $error['type'] = "error";
            $error['message'] = $validator->errors()->first();
            return response()->json($error);
        }
        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Configuracion::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Configuracion $configuracion)
    {
        $validator = Validator::make($request->all(),
        [
            'id_configuracion' => 'required',
            'hora_entrada' => 'required',
            'hora_salida' => 'required',
            'intervalo_conexion' => 'required'
        ]);
        if($validator->fails()){
            $error['type'] = "error";
            $error['message'] = $validator->errors()->first();
            return response()->json($error);
        }
        $configuracion->id_configuracion=$request->id_configuracion;
        $configuracion->hora_entrada=$request->hora_entrada;
        $configuracion->hora_salida=$request->hora_salida;
        $configuracion->intervalo_conexion=$request->intervalo_conexion;
        $configuracion->save();
        return response()->json($configuracion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuracion $configuracion)
    {
        $configuracion->delete();
        return response()->json("success");        
    }
}
