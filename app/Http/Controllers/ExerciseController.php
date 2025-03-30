<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\ExerciseResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    public function submit(Request $request, Lesson $lesson)
{
    $user = Auth::user();

    $results = [];

    foreach ($lesson->examples as $example) {
        $answer = $request->input('answers.' . $example->id);
        if (!$answer) continue;

        // Obtener solución correcta (puedes adaptar esto si tienes la solución en otro campo)
        preg_match('/\b([a-zA-Z]{2})\b/', strip_tags($example->example), $match);
        $correct = $match[1] ?? null;

        $isCorrect = strtolower($correct) === strtolower($answer);

        $results[$example->id] = [
            'correct' => $isCorrect,
            'expected' => $correct,
            'answer' => $answer,
        ];

        // Solo guardar si el usuario está logado
        if ($user) {
            ExerciseResult::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'example_id' => $example->id,
                    'lesson_id' => $lesson->id,
                ],
                [
                    'answer' => $answer,
                    'correct' => $isCorrect,
                    'completed' => false,
                ]
            );
        }
    }

    $allCorrect = collect($results)->every(fn($r) => $r['correct']);

    if ($user && $allCorrect) {
        ExerciseResult::where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->update(['completed' => true]);
    }

    return response()->json([
        'status' => 'ok',
        'message' => 'Respuestas evaluadas.',
        'completed' => $allCorrect,
        'results' => $results, // útil si luego quieres mostrar en frontend
    ]);
}

public function retry(Lesson $lesson)
{
    $user = Auth::user();

    if ($user) {
        ExerciseResult::where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->delete();
    }

    return response()->json(['status' => 'reset']);
}


  
}

