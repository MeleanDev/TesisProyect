<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
