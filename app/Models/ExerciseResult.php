<?php

// app/Models/ExerciseResult.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseResult extends Model
{
    protected $fillable = ['user_id', 'example_id', 'lesson_id', 'answer', 'correct', 'completed'];

    public function user() { return $this->belongsTo(User::class); }
    public function example() { return $this->belongsTo(Example::class); }
    public function lesson() { return $this->belongsTo(Lesson::class); }
}
