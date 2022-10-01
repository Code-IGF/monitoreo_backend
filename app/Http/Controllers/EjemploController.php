<?php

namespace App\Http\Controllers;

use App\Models\ejemplo;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class EjemploController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ejemplos=ejemplo::all();
        return $ejemplos;
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
        $ejemplo=request(['nombre','descripcion','cantidad']);
        ejemplo::create($ejemplo);
        return response()->json($ejemplo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ejemplo  $ejemplo
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {

        $ejemplo=ejemplo::findOrFail($id);
        return $ejemplo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ejemplo  $ejemplo
     * @return \Illuminate\Http\Response
     */
    public function edit(ejemplo $ejemplo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ejemplo  $ejemplo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ejemplo $ejemplo)
    {
        $ejemplo->nombre=request('nombre',"");
        $ejemplo->save();

        return $ejemplo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ejemplo  $ejemplo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ejemplo $ejemplo)
    {
        $ejemplo->delete();
        return response()->json('Se elimino');
    }
}
