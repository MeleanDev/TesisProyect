<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRegistradoRequest;
use App\Models\ClienteRegistrado;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ClienteController extends Controller
{
    public function index(): View
    {
        return view('interno.page.clientes');
    }

    public function lista()
    {
        $datos = ClienteRegistrado::where('estado', true)->get();
        foreach ($datos as $item) {
            $fotoOriginal = asset('storage/' . $item->image);
            $item->image = ($item->image == null) ? false : $fotoOriginal;
        }
        return datatables()->of($datos)->toJson();
    }

    public function detalle(ClienteRegistrado $id): JsonResponse
    {
        $id->image = asset('storage/' . $id->image);
        return response()->json(['success' => true, 'datos' => $id]);
    }

    public function guardar(ClienteRegistradoRequest $request): JsonResponse
    {
        try {
            $client = ClienteRegistrado::where('identidad', $request->identidad)->first();

            if (!$client) {
                $client = new ClienteRegistrado();
            }

            $nombreFoto = $client->image;
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $request->file('image')->storeAs('Clientes/', $filename, 'public');
                $nombreFoto = 'Clientes/' . $filename;
            }

            $client->fill($request->validated());
            $client->image = $nombreFoto;
            $client->estado = true;
            $client->save();
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json([
                'error' => true,
                'message' => 'Ocurrió un error al guardar el registro.',
                'exception' => $th->getMessage()
            ]);
        }

        return $respuesta;
    }

    public function editar($id, ClienteRegistradoRequest $datos): JsonResponse
    {
        try {
            $id = ClienteRegistrado::findOrFail($id);

            if ($datos->file('image') == null) {
                $nombreFoto = $id->image;
            } else {
                $extension = $datos->file('image')->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $datos->file('image')->storeAs('Clientes/', $filename, 'public');
                $nombreFoto = 'Clientes/' . $filename;
            }

            $id->Pnombre = $datos->validated('Pnombre');
            $id->Snombre = $datos->validated('Snombre');
            $id->Papelldio = $datos->validated('Papelldio');
            $id->Sapelldio = $datos->validated('Sapelldio');
            $id->identidad = $datos->validated('identidad');
            $id->telefono = $datos->validated('telefono');
            $id->email = $datos->validated('email');
            $id->fecha_nacimiento = $datos->validated('fecha_nacimiento');
            $id->image = $nombreFoto;
            $id->save();
            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => true]);
        }
        return $repuesta;
    }

    public function eliminar(ClienteRegistrado $id): JsonResponse
    {
        $id->estado = false;
        $id->save();
        return response()->json(['success' => true]);
    }
}
