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
        $preinscripciones = Preinscripcion::with('clienteRegistrado', 'curso')->get();

        foreach ($preinscripciones as $item) {
            $item->fecha_creacion_formateada = $item->created_at->format('d/m/Y H:i');
        }

        return datatables()->of($preinscripciones)->toJson();
    }

    public function guardar() {}

    public function editar() {}

    public function eliminar() {}
}
