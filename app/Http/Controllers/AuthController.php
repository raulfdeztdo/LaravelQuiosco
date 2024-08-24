<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegistroRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user'  => $user,
        ];
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (! auth()->attempt($data)) {
            return response()->json([
                'errors' => [
                    'Credenciales incorrectas',
                ],
            ], 401);
        }

        return [
            'token' => auth()->user()->createToken('token')->plainTextToken,
            'user'  => auth()->user(),
        ];
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada',
            'user'    => null,
        ]);
    }
}
