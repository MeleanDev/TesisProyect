<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactoRequest;
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
            $mensaje = new SeccionCurso();
            $mensaje->nombre = $datos['nombre'];
            $mensaje->apellido = $datos['apellido'];
            $mensaje->telefono = $datos['telefono'];
            $mensaje->correo = $datos['correo'];
            $mensaje->asunto = $datos['asunto'];
            $mensaje->mensaje = $datos['mensaje'];
            $mensaje->save(); 
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => false]);
        }
        return $repuesta;
    }

    public function preinscripcion(): View
    {
        return view('website.pages.preinscripcion');
    }

    public function cursoEmpresa(): View
    {
        return view('website.pages.cursoEmpresa');
    }

    public function cursoEjecutivo(): View
    {
        return view('website.pages.cursoEjecutivo');
    }

    public function cursoMenor(): View
    {
        return view('website.pages.cursoMenor');
    }
}
