<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Auth extends Controller
{
    // Registro

    public function registro(Request $request){

        //Validaciones
        $validator = Validator::make($request->all(),[
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        //Crear usuario si pasa la validacion (Guardar los datos en la BD)

        $user = User::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //Obtener id del usuario creado para asignarle un token

        $userId = User::where('email', $request['email'])->first();

        //Asignar PAT token al ID
        $token = $userId->createToken('auth_token')->plainTextToken;

        //Retornar Token en una respuesta JSON

        return response()->json([
           'token' => $token
        ]);
    }
}
