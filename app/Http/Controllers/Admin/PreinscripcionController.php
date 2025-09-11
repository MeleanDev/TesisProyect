<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Preinscripcion;
use Illuminate\View\View;

class PreinscripcionController extends Controller
{
    public function index(): View
    {
        return view('interno.page.preinscripciones');
    }

    public function lista()
    {
        $datos = Preinscripcion::with('clienteRegistrado', 'curso');
        return datatables()->of($datos)->toJson();
    }

    public function guardar()
    {

    }

    public function editar()
    {

    }

    public function eliminar()
    {

    }
}
