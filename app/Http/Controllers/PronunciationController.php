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

        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 403);
        }

        $example = Example::findOrFail($exampleId);

        $pronounCorrect = $request->input('correct') ? 1 : 0;

        ExerciseResult::updateOrCreate(
            [
                'user_id' => $user->id,
                'example_id' => $example->id,
            ],
            [
                'lesson_id' => $example->lesson_id,
                'pronoun' => $pronounCorrect,
            ]
        );

        return response()->json(['saved' => true]);
    }
}