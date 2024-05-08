<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HasPermisos;
use Illuminate\View\View;

class BienvenidaController extends Controller
{
    use HasPermisos;

    public function iniciar(Request $peticion): View
    {
        $permisos_usuario = $this->obtenerPermisosUsuario($peticion);
        return view('bienvenida')->with($permisos_usuario);
    }

    public function informar(): View
    {
        return view('informacion');
    }
}
