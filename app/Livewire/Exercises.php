<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lesson;
use App\Models\ExerciseResult;
use Illuminate\Support\Facades\Auth;

class Exercises extends Component
{
    public Lesson $lesson;
    public $answers = [];
    public $results = [];
    public bool $submitted = false;

    public $completed = false;

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;

        $user = Auth::user();

        // Cargar respuestas previas si existen
        foreach ($lesson->examples as $example) {
            $result = ExerciseResult::where('user_id', $user->id)
                ->where('example_id', $example->id)
                ->first();

            if ($result) {
                $this->answers[$example->id] = $result->answer;
                $this->results[$example->id] = $result->correct;
            }
        }

        // Ver si ya está completado
        $this->completed = ExerciseResult::where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->where('completed', true)
            ->exists();
    }

    public function submit()
{
    $user = Auth::user();

    foreach ($this->lesson->examples as $example) {
        $userAnswer = $this->answers[$example->id] ?? '';
        $correctAnswer = strtolower(trim($example->solution));

        $isCorrect = strtolower(trim($userAnswer)) === $correctAnswer;
        $this->results[$example->id] = $isCorrect;

        ExerciseResult::updateOrCreate(
            [
                'user_id' => $user->id,
                'example_id' => $example->id,
                'lesson_id' => $this->lesson->id,
            ],
            [
                'answer' => $userAnswer,
                'correct' => $isCorrect,
                'completed' => false,
            ]
        );
    }

    if (collect($this->results)->every(fn($val) => $val)) {
        ExerciseResult::where('user_id', $user->id)
            ->where('lesson_id', $this->lesson->id)
            ->update(['completed' => true]);

        $this->completed = true;
    }

    $this->submitted = true; // ✅ Añade esto
}


    public function retry()
    {
        $user = Auth::user();

        ExerciseResult::where('user_id', $user->id)
            ->where('lesson_id', $this->lesson->id)
            ->delete();

        $this->answers = [];
        $this->results = [];
        $this->completed = false;
    }

    public function render()
    {
        return view('livewire.exercises');
    }
}
