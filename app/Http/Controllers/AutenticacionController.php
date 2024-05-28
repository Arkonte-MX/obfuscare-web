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

    public function autenticar(Request $peticion): RedirectResponse
    {
        // https://es.stackoverflow.com/questions/398913/problema-con-socialite-google-en-laravel-7
        if (!$peticion->query->all()) {
            $parametros = [];
            parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $parametros);
            foreach ($parametros as $key => $value) {
                $peticion->query->set($key, $value);
            }
        }

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
