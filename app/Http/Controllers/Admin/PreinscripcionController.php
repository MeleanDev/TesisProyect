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
<<<<<<< HEAD
        $preinscripciones = Preinscripcion::with('clienteRegistrado', 'curso')->get();

        foreach ($preinscripciones as $item) {
            $item->fecha_creacion_formateada = $item->created_at->format('d/m/Y H:i');
        }

        return datatables()->of($preinscripciones)->toJson();
=======
        $datos = Preinscripcion::with('clienteRegistrado', 'curso');
        return datatables()->of($datos)->toJson();
>>>>>>> a8069d3cf252a5f21af83a1c2a8fe8888c379933
    }

    public function guardar() {}

    public function editar() {}

    public function eliminar() {}
}
