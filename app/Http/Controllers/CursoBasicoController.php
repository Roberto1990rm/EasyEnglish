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

        return redirect()->route('curso.basico.index')->with('success', 'Lección creada correctamente.');
    }

    public function index()
    {
        $lecciones = Leccion::all(); // Obtener todas las lecciones
        return view('curso_basico.index', compact('lecciones'));
    }

    public function show($id)
    {
        $leccion = Leccion::findOrFail($id); // 🔥 Asegura que se obtiene un objeto, no un array
    
        return view('curso_basico.show', compact('leccion'));
    }


}
