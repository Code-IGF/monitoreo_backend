<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Archivo;

class LogController extends Controller
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
        $validator = Validator::make($request->all(),
            [
                
                'descripcion' => 'required',
                
            ]);
            if($validator->fails())
            {
                //Recuperando error
                $error['type']="error";
                $error['message'] = $validator->errors()->first();
                return response()->json($error);
            }
        $user = auth()->user()->id;
        $log = request(['descripcion']);
        $log['user_id'] = $user;
        if($request->file()){
            $file = $request->file('imagen')->store('public/log');
            $urlFile = Storage::url($file);
            $archivo = [       'url'=> $urlFile,
                            'tipo' => 'png',
                            'nombre' => 'nombre',];
            $archivo = Archivo::create($archivo);
            $log['archivo_id'] = $archivo['archivo_id'];
        }
        $log = Log::create($log);
  
        return response()->json($log);
     


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        //
    }
}
