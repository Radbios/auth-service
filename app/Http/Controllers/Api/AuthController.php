<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function authenticate(AuthenticateRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            // event(new AuthenticationFailed($request, $user));
            throw ValidationException::withMessages([
                    'email' => ['Credenciais incorretas.'],
            ]);
        }

        $user = Auth::user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => new UserResource($user)
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        return response()->json(['message' => 'Deslogado com sucesso!']);
    }
}