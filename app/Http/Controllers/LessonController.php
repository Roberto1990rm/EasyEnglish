<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function create()
    {
        $courses = Course::all(); // Obtener todos los cursos
        return view('lessons.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|max:255',
            'description' => 'required',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'audio' => 'nullable|mimes:mp3,wav|max:5120',
            
        ]);

        // Almacenar imágenes
        $image1 = $request->file('image1') ? $request->file('image1')->store('images/lessons', 'public') : null;
        $image2 = $request->file('image2') ? $request->file('image2')->store('images/lessons', 'public') : null;
        $image3 = $request->file('image3') ? $request->file('image3')->store('images/lessons', 'public') : null;
        $audio = $request->file('audio') ? $request->file('audio')->store('audio/lessons', 'public') : null;

        Lesson::create([
            'course_id' => $request->course_id,
            'user_id' => auth()->id(), // 👈 AÑADIR ESTO
            'title' => $request->title,
            'description' => $request->description,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'video' => $request->video,
            'audio' => $audio,
            'example1' => $request->example1,
            'translation1' => $request->translation1,
            'example2' => $request->example2,
            'translation2' => $request->translation2,
        ]);
        

        return redirect()->route('courses.index')->with('success', 'Lección creada correctamente.');
    }



    public function edit(Lesson $lesson)
{
    return view('lessons.edit', compact('lesson'));
}

public function update(Request $request, Lesson $lesson)
{
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'audio' => 'nullable|mimes:mp3,wav|max:5120',
        'video' => 'nullable|string|max:255', // ✅ Añadir esta línea

    ]);

    // Guardar imágenes y audio si son reemplazados
    $lesson->update([
        'title' => $request->title,
        'description' => $request->description,
        'video' => $request->filled('video') ? $request->video : $lesson->video,

        'image1' => $request->file('image1') ? $request->file('image1')->store('images/lessons', 'public') : $lesson->image1,
        'image2' => $request->file('image2') ? $request->file('image2')->store('images/lessons', 'public') : $lesson->image2,
        'image3' => $request->file('image3') ? $request->file('image3')->store('images/lessons', 'public') : $lesson->image3,
        'audio' => $request->file('audio') ? $request->file('audio')->store('audio/lessons', 'public') : $lesson->audio,
    
        // 👇 Añadí estos campos:
        'example1' => $request->example1,
        'translation1' => $request->translation1,
        'example2' => $request->example2,
        'translation2' => $request->translation2,
    ]);

    return redirect()->route('courses.show', $lesson->course_id)->with('success', 'Lección actualizada correctamente.');
}


public function destroy(Lesson $lesson)
{
    // Eliminar archivos asociados (si existen)
    if ($lesson->image1) Storage::disk('public')->delete($lesson->image1);
    if ($lesson->image2) Storage::disk('public')->delete($lesson->image2);
    if ($lesson->image3) Storage::disk('public')->delete($lesson->image3);
    if ($lesson->audio) Storage::disk('public')->delete($lesson->audio);
    if ($lesson->video) Storage::disk('public')->delete($lesson->video);

    // Eliminar la lección
    $lesson->delete();

    return redirect()->route('courses.show', $lesson->course_id)->with('success', 'Lección eliminada correctamente.');
}
}
