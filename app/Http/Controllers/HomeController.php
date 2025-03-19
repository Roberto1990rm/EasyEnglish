<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener todos los cursos
        $courses = Course::all();

        // Pasar los cursos a la vista 'home'
        return view('home', compact('courses'));
    }
}
