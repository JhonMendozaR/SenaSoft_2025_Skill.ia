<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $usuario = Usuario::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'contrasena_hash' => Hash::make($request->contrasena),
            'departamento' => $request->departamento,
            'ciudad' => $request->ciudad,
            'barrio' => $request->barrio,
            'direccion' => $request->direccion,
            'experiencia_anos' => $request->experiencia_anos,
            'sector' => $request->sector,
            'aspiracion' => $request->aspiracion,
            'nivel_ingles_autoreporte' => $request->nivel_ingles_autoreporte,
            'seniority_autoreporte' => $request->seniority_autoreporte,
            'regimen_vinculacion' => $request->regimen_vinculacion,
            'perfil_objetivo_id' => $request->perfil_objetivo_id,
            'fecha_registro' => now(),
        ]);

        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'usuario' => $usuario,
            'token' => $token,
        ], 201);
    }

    public function login(AuthRequest $request)
    {
        $user = Usuario::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->contrasena_hash)) {
            return response()->json([
                'message' => 'Credenciales no correctas',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente',
        ]);
    }
}
