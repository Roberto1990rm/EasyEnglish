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
        $lessons = Lesson::with(['examples' => function ($query) {
            $query->with(['exerciseResult' => function ($q) {
                $q->where('user_id', Auth::id());
            }]);
        }])->has('examples')->orderBy('title')->paginate(5);

        return view('pronunciation', compact('lessons'));
    }

    public function guardarPronunciacion(Request $request, $exampleId)
    {
        $user = Auth::user();

        if (!$user) return response()->json(['error' => 'Unauthorized'], 401);

        $lessonId = Example::findOrFail($exampleId)->lesson_id;
        $pronounStatus = $request->input('pronoun', 0); // Asegura que usamos 'pronoun'

        ExerciseResult::updateOrCreate(
            [
                'user_id' => $user->id,
                'lesson_id' => $lessonId,
                'example_id' => $exampleId,
            ],
            [
                'pronoun' => $pronounStatus,
            ]
        );

        return response()->json(['ok' => true]);
    }
}
