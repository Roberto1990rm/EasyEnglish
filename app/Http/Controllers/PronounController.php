<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pronoun;
use App\Models\Leccion;
use Illuminate\Support\Facades\Storage;

class PronounController extends Controller
{
    // Mostrar el formulario de creación
    public function create($lesson_id)
    {
        $leccion = Leccion::findOrFail($lesson_id); // Obtener la lección asociada
        return view('pronouns.create', compact('leccion'));
    }

    // Guardar el pronombre en la base de datos
    public function store(Request $request, $lesson_id)
    {
        // Validar los datos del formulario
        $request->validate([
            'pronoun' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|mimes:mp4|max:10240',
            'audio' => 'nullable|mimes:mp3,wav|max:5120',
            'description' => 'nullable|string',
            'translation' => 'nullable|string',
            'example_1' => 'nullable|string',
            'example_2' => 'nullable|string'
        ]);

        // Subir archivos si existen
        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;
        $videoPath = $request->file('video') ? $request->file('video')->store('videos', 'public') : null;
        $audioPath = $request->file('audio') ? $request->file('audio')->store('audios', 'public') : null;

        // Crear el pronombre
        Pronoun::create([
            'lesson_id' => $lesson_id,
            'pronoun' => $request->pronoun,
            'image' => $imagePath,
            'video' => $videoPath,
            'audio' => $audioPath,
            'description' => $request->description,
            'translation' => $request->translation,
            'example_1' => $request->example_1,
            'example_2' => $request->example_2
        ]);

        return redirect()->route('curso.basico.show', $lesson_id)->with('success', 'Pronoun created successfully!');
    }




    public function destroy($lesson_id, $id)
{
    // Buscar el registro por su ID, si no lo encuentra lanza un error 404
    $pronoun = Pronoun::findOrFail($id);

    // Eliminar los archivos asociados si existen
    if ($pronoun->image) {
        Storage::disk('public')->delete($pronoun->image);
    }
    if ($pronoun->video) {
        Storage::disk('public')->delete($pronoun->video);
    }
    if ($pronoun->audio) {
        Storage::disk('public')->delete($pronoun->audio);
    }

    // Eliminar el registro de la base de datos
    $pronoun->delete();

    // Redireccionar con un mensaje de éxito
    return redirect()->route('curso.basico.show', $lesson_id)
                     ->with('success', 'Pronoun deleted successfully!');
}

}
