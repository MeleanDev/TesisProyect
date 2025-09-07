<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactoRequest;
use App\Models\Curso;
use App\Models\SeccionCurso;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    public function inicio(): View
    {
        return view('website.pages.inicio');
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
        return view('website.pages.preinscripcion');
    }

    public function cursoEmpresa(): View
    {
        $cursos = Curso::where('categoria','empresarial')->paginate(6);
        return view('website.pages.cursoEmpresa', compact('cursos'));
    }

    public function cursoEjecutivo(): View
    {
        $cursos = Curso::where('categoria','ejecutivo')->paginate(6);
        return view('website.pages.cursoEjecutivo', compact('cursos'));
    }

    public function cursoMenor(): View
    {
        $cursos = Curso::where('categoria','menores')->paginate(6);
        return view('website.pages.cursoMenor', compact('cursos'));
    }

    public function cursoDetalle(Curso $curso)
    {
        return view('website.pages.cursoDetalle', compact('curso'));
    }
}
