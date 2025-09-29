<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactoRequest;
use App\Http\Requests\VerificacionCliente;
use App\Models\ClienteRegistrado;
use App\Models\Curso;
use App\Models\Preinscripcion;
use App\Models\SeccionCurso;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
        $cursos = Curso::where('estado', true)->get();
        return view('website.pages.preinscripcion', compact('cursos'));
    }

    public function store(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            // 1. Validar los datos comunes a ambos escenarios
            $request->validate([
                'identidad' => 'required|string|max:255',
                'curso_id' => 'required|string|exists:cursos,slug',
            ]);

            // 2. Buscar si el cliente ya existe por su identidad
            $cliente = ClienteRegistrado::where('identidad', $request->input('identidad'))->first();
            $imagePath = null;

            if (!$cliente) {
                // Escenario 2: El cliente no existe, validar y crear uno nuevo

                // Reglas de validación para el nuevo cliente
                $validatedData = $request->validate([
                    'Pnombre' => 'required|string|max:255',
                    'Papelldio' => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:cliente_registrados,email',
                    'telefono' => 'required|string|max:255',
                    'fecha_nacimiento' => 'required|date',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                ]);

                // Lógica para subir y guardar la imagen
                if ($request->hasFile('image')) {
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $imagePath = 'Clientes/' . $filename;
                    $request->file('image')->storeAs('public/Clientes', $filename);
                }

                // Crear el nuevo registro de cliente
                $cliente = ClienteRegistrado::create(array_merge(
                    $validatedData,
                    [
                        'identidad' => $request->input('identidad'),
                        'image' => $imagePath,
                        'estado' => true
                    ]
                ));
            } else {
                // Escenario 1: El cliente ya existe
                // Actualizar su estado a 'true' si es necesario
                if (!$cliente->estado) {
                    $cliente->update(['estado' => true]);
                }
            }

            // 3. Obtener el ID del curso
            $curso = Curso::where('slug', $request->input('curso_id'))->firstOrFail();

            // 4. Verificar si la preinscripción ya existe para este cliente y curso
            $preinscripcionExistente = Preinscripcion::where('cliente_registrado_id', $cliente->id)
                ->where('curso_id', $curso->id)
                ->where('estado', 'Aceptado')
                ->orWhere('estado', 'Pendiente')
                ->orWhere('estado', 'Graduado')
                ->first();

            if ($preinscripcionExistente) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Ya existe una preinscripción para este cliente y curso.'
                ], 409); // 409 Conflict
            }

            // 5. Crear la nueva preinscripción
            $preinscripcion = new Preinscripcion();
            $preinscripcion->cliente_registrado_id = $cliente->id;
            $preinscripcion->curso_id = $curso->id;
            $preinscripcion->estado = 'Pendiente';
            $preinscripcion->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Preinscripción registrada exitosamente.',
                'referencia' => $preinscripcion->id
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error de validación: ' . $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error inesperado: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cursoEmpresa(): View
    {
        $cursos = Curso::where('categoria', 'empresarial')->where('estado', true)->paginate(6);
        return view('website.pages.cursoEmpresa', compact('cursos'));
    }

    public function cursoEjecutivo(): View
    {
        $cursos = Curso::where('categoria', 'ejecutivo')->where('estado', true)->paginate(6);
        return view('website.pages.cursoEjecutivo', compact('cursos'));
    }

    public function cursoMenor(): View
    {
        $cursos = Curso::where('categoria', 'menores')->where('estado', true)->paginate(6);
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
        $slug->image = asset('storage/' . $slug->image);
        return response()->json(['curso' => $slug]);
    }

    public function verCertificado($nombre): JsonResponse
    {
        try {
            
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['erro' => true]);
        }
        return $respuesta;
    }
}
