<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ofuscable;
use App\Traits\HasOfuscador;
use App\Traits\HasPermisos;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OfuscamientoController extends Controller
{
    use HasOfuscador, HasPermisos;

    public function ofuscar(Request $peticion): RedirectResponse
    {
        ["texto" => $texto] = $peticion->validate([
            "texto" => "required|min:3"
        ]);

        $palabras = explode(" ", trim($texto));
        $permisos_usuario = $this->obtenerPermisosUsuario($peticion);
        $procesadas = self::procesar($palabras, $permisos_usuario);

        return redirect()->route("ofuscamiento.presentar")->with([
            "palabras" => $palabras,
            "procesadas" => $procesadas
        ]);
    }

    public function presentar(Request $peticion): View | RedirectResponse
    {
        $procesadas = $peticion->session()->get("procesadas");

        if (!$procesadas || count($procesadas) < 1) {
            return redirect()->route("inicio");
        }

        $permisos_usuario = $this->obtenerPermisosUsuario($peticion);

        return view("presentar", [
            "palabras" => $peticion->session()->get("palabras"),
            "procesadas" => $procesadas,
            "permisos" => $permisos_usuario
        ]);
    }

    public function notificar(Request $peticion): JsonResponse
    {
        $id_usuario = auth()->user()->id;

        $faltantes = array_map(function ($faltante) use ($id_usuario) {
            return [
                "valor" => $faltante,
                "id_alternativa" => null,
                "id_severidad" => null,
                "id_usuario" => $id_usuario,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        }, $peticion->input('faltantes'));

        Ofuscable::insertOrIgnore($faltantes);

        return response()->json([
            "mensaje" => "Muchas gracias por la notificación, las palabras faltantes fueron reordenadas de forma aleatoria y enviadas para próximamente ser añadidas a la base de datos"
        ]);
    }
}
