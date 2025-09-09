<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
        public function index()
    {
        return view('interno.page.administradores');
    }

    public function lista()
    {
            $administradores = User::all();
             return datatables()->of($administradores)->toJson();
    }

    public function detalle($id)
    {
        $administrador = User::findOrFail($id);
        return response()->json($administrador);
    }

    public function guardar(Request $datos)
    {
        $administrador = new User();
        $administrador->name = $datos['name'];
        $administrador->email = $datos['email'];
        $administrador->password = Hash::make($datos['password']);
        $administrador->save();

        return response()->json(['success' => true]);
    }

    public function editar(Request $datos, $id)
    {
        $administrador = User::findOrFail($id);
        $administrador->name = $datos['name'];
        $administrador->email = $datos['email'];
        $administrador->password = Hash::make($datos['password']);
        $administrador->save();

        return response()->json(['success' => true]);
    }

    public function eliminar($id)
    {
        $administrador = User::findOrFail($id);
        $administrador->delete();

        return response()->json(['success' => true]);
    }
}
