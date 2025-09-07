<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactoDosRequest;
use App\Http\Requests\ContactoRequest;
use App\Http\Requests\VerificacionCliente;
use App\Models\ClienteRegistrado;
use App\Models\Curso;
use App\Models\SeccionCurso;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public function inicio(): View
    {
        // count cantidad de curso
        $cursoMenorCantidad = Curso::where('categoria', 'menores')->count();
        $cursoEjecutivoCantidad = Curso::where('categoria', 'ejecutivo')->count();
        $cursoEmpresaCantidad = Curso::where('categoria', 'empresarial')->count();

        // 4 registros de cada curso 
        $cursoMenorCuatroPrimero = Curso::where('categoria', 'menores')->limit(4)->get();
        $cursoEjecutivoCuatroPrimero = Curso::where('categoria', 'ejecutivo')->limit(4)->get();
        $cursoEmpresaCuatroPrimero = Curso::where('categoria', 'empresarial')->limit(4)->get();

        return view('website.pages.inicio', compact(
            'cursoMenorCantidad',
            'cursoEjecutivoCantidad',
            'cursoEmpresaCantidad',
            'cursoMenorCuatroPrimero',
            'cursoEjecutivoCuatroPrimero',
            'cursoEmpresaCuatroPrimero',
        ));
    }

    public function contacto(): View
    {
        return view('website.pages.contacto');
    }

    public function formContacto(ContactoRequest $datos): JsonResponse
    {
        try {
            SeccionCurso::create($datos->validated());
            $repuesta = response()->json(['success' => true]);
        } catch (\Exception $e) {
            return $repuesta = response()->json(['error' => false]);
        }
        return $repuesta;
    }

    public function preinscripcion(): View
    {
        $cursos = Curso::all();
        return view('website.pages.preinscripcion', compact('cursos'));
    }

    public function cursoEmpresa(): View
    {
        $cursos = Curso::where('categoria', 'empresarial')->paginate(6);
        return view('website.pages.cursoEmpresa', compact('cursos'));
    }

    public function cursoEjecutivo(): View
    {
        $cursos = Curso::where('categoria', 'ejecutivo')->paginate(6);
        return view('website.pages.cursoEjecutivo', compact('cursos'));
    }

    public function cursoMenor(): View
    {
        $cursos = Curso::where('categoria', 'menores')->paginate(6);
        return view('website.pages.cursoMenor', compact('cursos'));
    }

    public function cursoDetalle(Curso $curso)
    {
        return view('website.pages.cursoDetalle', compact('curso'));
    }

    public function verificacionCliente(VerificacionCliente $datos)
    {
        try {
            $cliente = ClienteRegistrado::where('identidad', $datos->identidad)->firstOrFail();
            $respuesta = response()->json(['existe' => true, 'cliente' => $cliente]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $respuesta = response()->json(['existe' => false, 'error' => 'No se encontró el registro.']);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true, 'mensaje' => 'Ha ocurrido un error inesperado.']);
        }
        return $respuesta;
    }

    public function detalleCurso(Curso $slug)
    {
        return response()->json(['curso' => $slug]);
    }
}
