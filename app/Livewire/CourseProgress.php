<?php

namespace App\Livewire;

use App\Models\Lesson;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CourseProgress extends Component
{
    public $course;

    public function mount($course)
    {
        $this->course = $course;
    }

    public function render()
    {
        $userId = Auth::id();
        $totalLessons = $this->course->lessons->count();

        $completedLessons = Lesson::whereHas('exerciseResults', function ($q) use ($userId) {
            $q->where('user_id', $userId)->where('completed', true);
        })
        ->where('course_id', $this->course->id)
        ->count();

        $percentage = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;

        return view('livewire.course-progress', compact('totalLessons', 'completedLessons', 'percentage'));
    }
}
