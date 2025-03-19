<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images/courses', 'public');

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'author' => Auth::user()->name,  // Toma el nombre del usuario autenticado
        ]);

        return redirect()->route('courses.index')->with('success', 'Curso creado correctamente.');
    }

    public function destroy(Course $course)
{
    // Eliminar imagen asociada si existe
    if ($course->image && Storage::disk('public')->exists($course->image)) {
        Storage::disk('public')->delete($course->image);
    }

    // Eliminar curso de la base de datos
    $course->delete();

    return redirect()->route('courses.index')->with('success', 'Curso eliminado correctamente.');
}
}
