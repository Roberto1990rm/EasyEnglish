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

        foreach ($lesson->examples as $example) {
            $answer = $request->input('answers.' . $example->id);
            if (!$answer) continue;

            preg_match('/\b([a-zA-Z]{2})\b/', strip_tags($example->example), $match);
            $correct = $match[1] ?? null;

            ExerciseResult::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'example_id' => $example->id,
                    'lesson_id' => $lesson->id,
                ],
                [
                    'answer' => $answer,
                    'correct' => strtolower($correct) === strtolower($answer),
                    'completed' => false,
                ]
            );
        }

        // Comprobar si todos los ejercicios están correctos
        $allCorrect = $lesson->examples->every(function ($example) use ($user) {
            return ExerciseResult::where('user_id', $user->id)
                ->where('example_id', $example->id)
                ->where('correct', true)
                ->exists();
        });

        if ($allCorrect) {
            ExerciseResult::where('user_id', $user->id)
                ->where('lesson_id', $lesson->id)
                ->update(['completed' => true]);
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'Respuestas guardadas correctamente.',
            'completed' => $allCorrect,
        ]);
    }

    public function retry(Lesson $lesson)
    {
        ExerciseResult::where('user_id', auth()->id())
            ->where('lesson_id', $lesson->id)
            ->delete();

        return response()->json(['status' => 'reset']);
    }
}

