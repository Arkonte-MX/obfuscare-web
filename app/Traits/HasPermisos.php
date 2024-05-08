<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HasPermisos
{
    public function obtenerPermisosUsuario(Request $peticion): array
    {
        $nivel_acceso = (!!$peticion->user())
            ? "autenticado"
            : "invitado";

        $permisos = config("permisos.{$nivel_acceso}");

        return [
            "minimo_caracteres" => $permisos['campo']['caracteres']['minimo'],
            "maximo_caracteres" => $permisos['campo']['caracteres']['maximo'],
            "maximo_palabras" => $permisos['procesar']['palabras']['maximo']
        ];
    }
}
