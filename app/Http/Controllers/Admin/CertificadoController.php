<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificacion;
use App\Models\ClienteRegistrado;
use App\Models\Curso;
use App\Models\Preinscripcion;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificadoController extends Controller
{
    public function index(): View
    {   
        $cursos = Curso::where('estado', true)->get();
        $cliente = ClienteRegistrado::where('estado', true)->get();
        return view('interno.page.certificado', compact('cliente', 'cursos'));
    }

    public function lista()
    {
        $datos = Certificacion::with('clienteRegistrado', 'curso')->get();
        return datatables()->of($datos)->toJson();
    }

    public function detalle(Preinscripcion $id)
    {

    }

    public function guardar(Request $datos)
    {
        try {
            $certi = new Certificacion();
            $certi->clienteRegistrado()->associate($datos->clienteRegistrado);
            $certi->curso()->associate($datos->curso);
            $certi->codigo = $datos->codigo;
            $certi->ruta = $datos->ruta;
            $certi->save();
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function eliminar()
    {

    }
}
