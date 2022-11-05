<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','me2']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request  $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required',
            'email'=> 'required',
            'fecha_nacimiento'=> 'required',
            'rol'=> 'required',
        ]);
        if($validator->fails())
        {
            return response()->json('completarInfo');
        }
        //Datos del usuario
        $credentials = request(['name','email', 'password', 'fecha_nacimiento']);
        $credentials['password']=bcrypt($credentials['password']);
        //Imagen de Perfil
        $file = $request->file('imagen')->store('public/fotos');
        $credentials['image_path']=$file;
        $urlFile=Storage::url($file);
        $credentials['imagen']=$urlFile;
        //Creando nuevo usuario
        $user=User::create($credentials);
        $user->assignRole(request(['rol']));
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $area
     * @return \Illuminate\Http\Response
     */
    public function eliminar(User $user)
    {
        $user->delete();
        return response()->json("success");
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    public function ActualizarPerfil(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required',
            'email'=> 'required',
            'fecha_nacimiento'=> 'required',
        ]);
        if($validator->fails())
        {
            //Recuperando error
            $error['type']="error";
            $error['message'] = $validator->errors()->first();
            return response()->json($error);
        }
        $user = auth()->user();//Información del usuario
        
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->fecha_nacimiento = $request['fecha_nacimiento'];
        
        //Si exite un archivo en el request
        if($request->file()){
            Storage::delete($user->image_path);
            $file = $request->file('imagen')->store('public/fotos');
            $user->image_path=$file;
            $urlFile=Storage::url($file);
            $user->imagen=$urlFile;
        }
        $user->save();
        
        return response()->json("success");
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
            'rol' => auth()->user()->getRoleNames()  
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required',
            'email'=> 'required',
            'fecha_nacimiento'=> 'required',
            'rol'=> 'required',
        ]);
        if($validator->fails())
        {
            return response()->json('completarInfo');
        }
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->fecha_nacimiento = $request['fecha_nacimiento'];
        
        //Si exite un archivo en el request
        if($request->file()){
            Storage::delete($user->image_path);
            $file = $request->file('imagen')->store('public/fotos');
            $user->image_path=$file;
            $urlFile=Storage::url($file);
            $user->imagen=$urlFile;
        }

        if($request['rol']!== 0){
            $user->roles()->detach();
            $user->assignRole($request['rol']);
        }
        $user->save();
        return response()->json($request['rol']);
        //return response()->json($request->all());
    }

}