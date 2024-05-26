<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HasPermisos;
use Illuminate\View\View;

class BienvenidaController extends Controller
{
    use HasPermisos;

    public function mostrarInicio(Request $peticion): View
    {
        $permisos_usuario = $this->obtenerPermisosUsuario($peticion);
        return view('inicio')->with($permisos_usuario);
    }

    public function mostrarInformacion(): View
    {
        return view('informacion');
    }

    public function mostrarAcerca(): View
    {
        return view('acerca');
    }
}
