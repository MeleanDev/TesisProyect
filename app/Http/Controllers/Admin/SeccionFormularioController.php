<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeccionCurso;
use Illuminate\View\View;

class SeccionFormularioController extends Controller
{
    public function index(): View
    {
        return view('interno.page.mensajeFormulario');
    }

    public function lista()
    {
        $datos = SeccionCurso::all();
        foreach ($datos as $item) {
           $item->fecha_creacion_formateada = $item->created_at->format('d/m/Y H:i:s');
        }
        return datatables()->of($datos)->toJson();
    }

    public function detalle($id)
    {
        $datos = SeccionCurso::findOrFail($id);
        return response()->json($datos);
    }   
}
