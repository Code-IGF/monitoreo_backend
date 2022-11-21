<?php

namespace App\Http\Controllers;

use App\Models\SalaTrabajo;
use Illuminate\Http\Request;
use App\Models\Equipo;

class SalaTrabajoController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaTrabajo  $salaTrabajo
     * @return \Illuminate\Http\Response
     */
    public function show(SalaTrabajo $salaTrabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaTrabajo  $salaTrabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaTrabajo $salaTrabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaTrabajo  $salaTrabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaTrabajo $salaTrabajo)
    {
        $userId= auth()->user()->id;
        $equipo=Equipo::find($salaTrabajo->equipos_id);
        if($equipo->supervisor_id==$userId){
            $salaTrabajo->hora_entrada=$request["hora_entrada"];
            $salaTrabajo->hora_salida=$request["hora_salida"];
            $salaTrabajo->intervalo_conexion=$request["intervalo_conexion"];
            $salaTrabajo->save();
            return "success";
        }
        else{
            return "Modificación no permitida.";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaTrabajo  $salaTrabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaTrabajo $salaTrabajo)
    {
        //
    }
}
