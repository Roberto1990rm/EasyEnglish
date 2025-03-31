<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\ExerciseResult;
use Illuminate\Support\Facades\Auth;
use App\Models\Example;

class PronunciationController extends Controller
{


public function index()
{
    $lessons = Lesson::with('examples')
        ->has('examples')
        ->orderBy('title')
        ->paginate(5); // 5 lecciones por página

    return view('pronunciation', compact('lessons'));
}

public function guardarPronunciacion(Request $request, $exampleId)
{
    $user = Auth::user();

    if (!$user) return response()->json(['error' => 'Unauthorized'], 401);

    $lessonId = \App\Models\Example::findOrFail($exampleId)->lesson_id;
    $status = $request->input('status', 0); // por defecto 0

    ExerciseResult::updateOrCreate(
        [
            'user_id' => $user->id,
            'lesson_id' => $lessonId,
            'example_id' => $exampleId,
        ],
        [
            'pronoun' => $status,
        ]
    );

    return response()->json(['ok' => true]);
}

}