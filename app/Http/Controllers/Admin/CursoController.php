<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\ClienteRegistrado;
use App\Mail\AnuncioNuevoCurso;
use Illuminate\Support\Facades\Mail;

class CursoController extends Controller
{
    public function index(): View
    {
        return view('interno.page.cursos');
    }

    public function lista()
    {
        $cursos = Curso::where('estado', true)->get();
        $fotoReserva = asset('assets/img/stock.png');
        foreach ($cursos as $curso) {
            $fotoOriginal = asset('storage/' . $curso->image);
            $curso->image = ($curso->image == null) ? $fotoReserva : $fotoOriginal;
        }
        return datatables()->of($cursos)->toJson();
    }

    public function detalle($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->image = asset('storage/' . $curso->image);
        return response()->json($curso);
    }

    public function guardar(Request $request): JsonResponse
    {
        try {
            $curso = Curso::where('slug', Str::slug($request['nombre']))->first();

            // <-- 1. Creamos una "bandera" para saber si el curso es nuevo
            $esNuevo = false;

            if (!$curso) {
                $curso = new Curso();
                // <-- 2. Si el curso no existe, marcamos la bandera como verdadera
                $esNuevo = true;
            }

            $nombreFoto = $curso->image;
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $request->file('image')->storeAs('cursos/', $filename, 'public');
                $nombreFoto = 'cursos/' . $filename;
            }

            $validatedData = $request->validate([
                'nombre' => 'required|string',
                'descripcion' => 'required|string',
                'precio' => 'required|numeric',
                'horasAcademicas' => 'required|integer',
                'maximoParticipantes' => 'required|integer',
                'modalidad' => 'required|string',
                'certificacion' => 'required|string',
                'tipoCurso' => 'required|string',
                'categoria' => 'required|string',
                'idioma' => 'required|string',
            ]);

            $curso->fill($validatedData);
            $curso->slug = Str::slug($request['nombre']);
            $curso->image = $nombreFoto;
            $curso->estado = true;
            $curso->save();

            // <-- 3. Después de guardar, comprobamos la bandera
            if ($esNuevo) {
                // Si la bandera es verdadera, obtenemos los clientes y ponemos los correos en la cola
                $clientes = ClienteRegistrado::where('estado', true)->get();
                foreach ($clientes as $cliente) {
                    Mail::to($cliente->email)->queue(new AnuncioNuevoCurso($curso, $cliente));
                }
            }

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

    public function editar(Request $request, $id)
    {
        try {
            $curso = Curso::findOrFail($id);

            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $request->file('image')->storeAs('cursos/', $filename, 'public');
                $nombreFoto = 'cursos/' . $filename;
                $curso->image = $nombreFoto;
            }

            $curso->nombre = $request['nombre'];
            $curso->slug = Str::slug($request['nombre']);
            $curso->descripcion = $request['descripcion'];
            $curso->precio = $request['precio'];
            $curso->horasAcademicas = $request['horasAcademicas'];
            $curso->maximoParticipantes = $request['maximoParticipantes'];
            $curso->modalidad = $request['modalidad'];
            $curso->certificacion = $request['certificacion'];
            $curso->tipoCurso = $request['tipoCurso'];
            $curso->categoria = $request['categoria'];
            $curso->idioma = $request['idioma'];
            $curso->save();

            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
        return $respuesta;
    }

    public function eliminar($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->estado = false;
        $curso->save();
        return response()->json(['success' => true]);
    }
}
