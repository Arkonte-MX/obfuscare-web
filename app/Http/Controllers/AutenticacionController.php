<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class AutenticacionController extends Controller
{
    public function solicitar(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function autenticar(): RedirectResponse
    {
        $proveedor = Socialite::driver('google');
        $cuenta = $proveedor->user();

        if (!!$cuenta) {
            $usuario = User::firstOrCreate(
                [
                    "email" => $cuenta->getEmail()
                ],
                [
                    "name" => $cuenta->getName(),
                    "remember_token" => $cuenta->refreshToken
                ]
            );

            if (!!$usuario) {
                Auth::login($usuario);
            }
        }

        return redirect()->route('inicio');
    }

    public function salir(): RedirectResponse
    {
        $usuario = auth()->user();

        if ($usuario) {
            $usuario->tokens()->delete();
            Auth::guard('web')->logout();
        }

        return redirect()->route('inicio');
    }
}
