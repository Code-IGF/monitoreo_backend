<?php

namespace App\Http\Controllers;

use App\Models\ejemploRa20073;
use Illuminate\Http\Request;

class EjemploRa20073Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $ejemploRa20073=ejemploRa20073::all();
        return $ejemploRa20073;
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
        $ejemploRa20073=request(['nombre','descripcion','cantidad']);
        ejemploRa20073::create($ejemploRa20073);
        return response()->json($ejemploRa20073);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ejemploRa20073  $ejemploRa20073
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $ejemploRa20073=ejemploRa20073::findOrfail($id);
        return $ejemploRa20073;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ejemploRa20073  $ejemploRa20073
     * @return \Illuminate\Http\Response
     */
    public function edit(ejemploRa20073 $ejemploRa20073)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ejemploRa20073  $ejemploRa20073
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ejemploRa20073 $ejemploRa20073)
    {
       $ejemploRa20073->nombre=request('nombre','');
       $ejemploRa20073->save();
       return $ejemploRa20073;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ejemploRa20073  $ejemploRa20073
     * @return \Illuminate\Http\Response
     */
    public function destroy(ejemploRa20073 $ejemploRa20073)
    {
         $ejemploRa20073->delete();
         return response()->json('se elimino');
    }
}
