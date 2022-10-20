<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
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
        $file =$request->file('foto')->store('public/fotos');

        return response()->json($file);
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
