<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificacion;
use App\Models\ClienteRegistrado;
use App\Models\Curso;
use App\Models\Preinscripcion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Mail\NotificacionCertificado;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class CertificadoController extends Controller
{
    public function index(): View
    {
        // Obtenemos los clientes como ya lo hacías
        $cliente = ClienteRegistrado::whereHas('preinscripcions', function ($query) {
            $query->where('estado', 'Aceptado');
        })->get();

        // 👇 AÑADIDO: Obtenemos todos los cursos para el filtro y los pasamos a la vista
        $cursos = Curso::orderBy('nombre')->get();

        return view('interno.page.certificado', compact('cliente', 'cursos'));
    }

    // En CertificadoController.php

public function lista(Request $request)
{
    // 1. Usamos JOIN para unir las tablas y SELECT para definir las columnas y sus alias
    $query = Certificacion::query()
        ->join('cliente_registrados', 'certificacions.cliente_registrado_id', '=', 'cliente_registrados.id')
        ->join('cursos', 'certificacions.curso_id', '=', 'cursos.id')
        ->select([
            'certificacions.id',
            'certificacions.codigo',
            'certificacions.created_at',
            'cliente_registrados.identidad as cliente_identidad', // Alias para el cliente
            'cursos.nombre as curso_nombre'                      // Alias para el curso
        ]);

    // 2. Aplicamos los filtros personalizados
    $query->when($request->curso_id, function ($q, $curso_id) {
        return $q->where('certificacions.curso_id', $curso_id);
    });
    $query->when($request->fecha_desde, function ($q, $fecha_desde) {
        return $q->whereDate('certificacions.created_at', '>=', $fecha_desde);
    });
    $query->when($request->fecha_hasta, function ($q, $fecha_hasta) {
        return $q->whereDate('certificacions.created_at', '<=', $fecha_hasta);
    });

    // 3. Pasamos la consulta a DataTables.
    return DataTables::of($query)->make(true);
}

    public function detalle($id): JsonResponse
    {
        $certificacion = Certificacion::with('clienteRegistrado', 'curso')->find($id->id);
        if (!$certificacion) {
            return response()->json(['error' => 'Certificación no encontrada'], 404);
        }
        return response()->json($certificacion);
    }

    public function guardar(Request $datos): JsonResponse
    {
        try {
            // Validar todos los campos
            $validated = $datos->validate([
                'pdf_certificado' => 'required|file|mimes:pdf|max:10240',
                'codigo_certificado' => 'required|string|max:255',
                'estudiante_id' => 'required|exists:cliente_registrados,id',
                'curso_id' => 'required|exists:cursos,id'
            ]);

            // Procesar archivo
            $archivo = $datos->file('pdf_certificado');
            $filename = time() . '_' . $datos->curso_id . '.' . $archivo->getClientOriginalExtension(); // Nombre más robusto
            $ruta = $archivo->storeAs('Certificados', $filename, 'public');

            // Guardar en base de datos
            $certi = new Certificacion();
            $certi->cliente_registrado_id = $datos->estudiante_id;
            $certi->curso_id = $datos->curso_id;
            $certi->codigo = $datos->codigo_certificado;
            $certi->pdfcertificado = $ruta;
            $certi->save();

            // Actualizar estado de Preinscripcion
            $preinscripcion = Preinscripcion::where('cliente_registrado_id', $datos->estudiante_id)->where('curso_id', $datos->curso_id)->first();
            if ($preinscripcion) {
                $preinscripcion->estado = 'Graduado';
                $preinscripcion->save();
            }

            $certi->load('clienteRegistrado', 'curso');
            Mail::to($certi->clienteRegistrado->email)->send(new NotificacionCertificado($certi));

            return response()->json(['success' => true, 'message' => 'Certificado guardado y notificado correctamente']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getMessage()]);
        }
    }

    public function usuarioCursos($id): JsonResponse
    {
        try {
            $cursos = Curso::whereHas('preinscripcions', function ($query) use ($id) {
                $query->where('cliente_registrado_id', $id)
                    ->where('estado', 'Aceptado');
            })->get(['id', 'nombre']);
            $respuesta = response()->json(['success' => true, 'cursos' => $cursos]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function eliminar(Certificacion $id): JsonResponse
    {
        try {

            $preinscripcion = Preinscripcion::where('cliente_registrado_id', $id->cliente_registrado_id)->where('curso_id', $id->curso_id)->first();
            $preinscripcion->estado = 'Aceptado';
            $preinscripcion->save();
            $id->delete();
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json([
                'error' => true,
                'type' => get_class($th),
                'message' => $th->getMessage(),
            ]);
        }
        return $respuesta;
    }

    public function ver(Certificacion $id): JsonResponse
    {
        try {
            $id->pdfcertificado = asset('storage/' . $id->pdfcertificado);
            $respuesta = response()->json(['success' => true, 'url' => $id->pdfcertificado]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }
}
