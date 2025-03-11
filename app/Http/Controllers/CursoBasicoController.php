<?php

namespace App\Http\Controllers;
use App\Models\Leccion;
use Illuminate\Http\Request;

class CursoBasicoController extends Controller
{

    public function create()
    {
        return view('curso_basico.create'); // Asegúrate de que la vista existe
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Subir imagen
        $path = $request->file('image')->store('images', 'public');

        // Guardar en la base de datos
        Leccion::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path
        ]);

        return redirect()->route('curso_basico.index')->with('success', 'Lección creada correctamente.');
    }

    public function index()
    {
        $lecciones = [
            ['id' => 1, 'title' => 'Lección 1', 'image' => 'leccion1.jpg', 'description' => 'Descripción de la Lección 1'],
            ['id' => 2, 'title' => 'Lección 2', 'image' => 'leccion2.jpg', 'description' => 'Descripción de la Lección 2'],
            ['id' => 3, 'title' => 'Lección 3', 'image' => 'leccion3.jpg', 'description' => 'Descripción de la Lección 3']
        ];

        return view('curso_basico.index', compact('lecciones'));
    }

    public function show($id)
    {
        $lecciones = [
            1 => ['title' => 'Lección 1', 'image' => 'leccion1.jpg', 'description' => 'Contenido completo de la Lección 1'],
            2 => ['title' => 'Lección 2', 'image' => 'leccion2.jpg', 'description' => 'Contenido completo de la Lección 2'],
            3 => ['title' => 'Lección 3', 'image' => 'leccion3.jpg', 'description' => 'Contenido completo de la Lección 3']
        ];

        if (!isset($lecciones[$id])) {
            abort(404);
        }

        return view('curso_basico.show', ['leccion' => $lecciones[$id]]);
    }


}
