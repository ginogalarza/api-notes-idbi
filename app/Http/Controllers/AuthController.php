<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) 
    {
        $user = User::create([
            'name'     =>  $request->name,
            'email'    =>  $request->email,
            'password' =>  Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token'        => $token,
            'message'      => 'Usuario registrado correctamente.',
            'type_token'   => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        if ( !Auth::attempt(['email' => $request->email, 'password' => $request->password]) ) {
            return response()->json([
                'error'   => true,
                'message' => 'Datos invalidos para el inicio de sesión.'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token'        => $token,
            'message'      => 'Correcto inicio de sesión.',
            'type_token'   => 'Bearer'
        ]);
    }
}
