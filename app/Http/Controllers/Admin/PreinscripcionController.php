<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Preinscripcion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    public function aceptar(Preinscripcion $id, Request $datos): JsonResponse
    {
        try {
            $id->estado = 'Aceptado';
            $id->comentario = $datos->comentario;
            $id->save();
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => true]);
        }
        return $repuesta;
    }

    public function anular(Preinscripcion $id, Request $datos): JsonResponse
    {
        try {
            $id->estado = 'Negado';
            $id->comentario = $datos->comentario;
            $id->save();
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => true]);
        }
        return $repuesta;
    }
}
