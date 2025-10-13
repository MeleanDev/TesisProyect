<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClienteRegistrado;
use App\Models\Curso;
use App\Models\MesCantidad;
use App\Models\Preinscripcion;
use App\Models\User;

class dashboardController extends Controller
{
    public function index()
    {
        $administradores = User::count();
        $clientes = ClienteRegistrado::where('estado', true)->count();
        $cursos = Curso::where('estado', true)->count();
        $preinscripciones = Preinscripcion::count();
        return view('interno.page.panelPrincipal', compact('administradores', 'clientes', 'cursos', 'preinscripciones'));
    }

        public function grafica()
    {
        $mes = MesCantidad::all();
        $data = [];
        foreach ($mes as $item) {
            $data['label'][] = $item->mes; 
            $data['data'][] = $item->cantidad;
        }
        return response()->json($data);
    }
}
