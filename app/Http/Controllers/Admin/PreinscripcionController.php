<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Preinscripcion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

// === IMPORTS PARA EL EMAIL ===
use App\Mail\NotificacionPreinscripcion;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class PreinscripcionController extends Controller
{
    public function index(): View
    {
        return view('interno.page.preinscripciones');
    }

    public function lista(Request $request)
    {
        $query = Preinscripcion::with('clienteRegistrado', 'curso')->select('preinscripcions.*');

        $query->when($request->estado, function ($q, $estado) {
            return $q->where('estado', $estado);
        });

        $query->when($request->fecha_desde, function ($q, $fecha_desde) {
            return $q->whereDate('preinscripcions.created_at', '>=', $fecha_desde);
        });

        $query->when($request->fecha_hasta, function ($q, $fecha_hasta) {
            return $q->whereDate('preinscripcions.created_at', '<=', $fecha_hasta);
        });

        return DataTables::of($query)
            ->addColumn('fecha_creacion_formateada', function ($preinscripcion) {
                return $preinscripcion->created_at->format('d/m/Y H:i');
            })  
            ->filterColumn('cliente_registrado.identidad', function ($query, $keyword) {
                $query->whereHas('clienteRegistrado', function ($q) use ($keyword) {
                    $q->where('identidad', 'like', "%{$keyword}%");
                });
            })

            ->filterColumn('curso.nombre', function ($query, $keyword) {
                $query->whereHas('curso', function ($q) use ($keyword) {
                    $q->where('nombre', 'like', "%{$keyword}%");
                });
            })

            ->make(true);
    }

    public function aceptar(Preinscripcion $id, Request $datos): JsonResponse
    {
        try {
            $id->estado = 'Aceptado';
            $id->comentario = $datos->comentario;
            $id->save();

            $datosParaEmail = [
                'nombres' => $id->clienteRegistrado->Pnombre,
                'apellidos' => $id->clienteRegistrado->Papelldio,
                'cedula' => $id->clienteRegistrado->identidad,
                'correo' => $id->clienteRegistrado->email,
                'nombre_curso' => $id->curso->nombre,
                'precio_curso' => $id->curso->precio,
                'fecha_registro' => Carbon::parse($id->created_at)->format('d/m/Y h:i A'),
                'estatus' => $id->estado,
            ];

            $mensajeDelAdmin = $datos->comentario;

            Mail::to($id->clienteRegistrado->email)->send(new NotificacionPreinscripcion($datosParaEmail, $mensajeDelAdmin));

            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => true, 'message' => $th->getMessage()]);
        }
        return $repuesta;
    }

    public function anular(Preinscripcion $id, Request $datos): JsonResponse
    {
        try {
            $id->estado = 'Negado';
            $id->comentario = $datos->comentario;
            $id->save();

            $datosParaEmail = [
                'nombres' => $id->clienteRegistrado->Pnombre,
                'apellidos' => $id->clienteRegistrado->Papelldio,
                'cedula' => $id->clienteRegistrado->identidad,
                'correo' => $id->clienteRegistrado->email,
                'nombre_curso' => $id->curso->nombre,
                'precio_curso' => $id->curso->precio,
                'fecha_registro' => Carbon::parse($id->created_at)->format('d/m/Y h:i A'),
                'estatus' => $id->estado, // Usamos el nuevo estado "Negado"
            ];
            $mensajeDelAdmin = $datos->comentario;

            // 3. Enviamos el correo
            Mail::to($id->clienteRegistrado->email)->send(new NotificacionPreinscripcion($datosParaEmail, $mensajeDelAdmin));

            $repuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => true, 'message' => $th->getMessage()]);
        }
        return $repuesta;
    }
}
