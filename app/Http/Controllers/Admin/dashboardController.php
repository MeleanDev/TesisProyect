<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClienteRegistrado;
use App\Models\User;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $administradores = User::count();
        $clientes = ClienteRegistrado::where('estado', true)->count();
        return view('interno.page.panelPrincipal', compact('administradores', 'clientes'));
    }
}
