<?php
// app/Models/Example.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $fillable = ['lesson_id', 'example','solution', 'translation'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }


    public function exerciseResult()
{
    return $this->hasOne(\App\Models\ExerciseResult::class)
        ->where('user_id', auth()->id()); // Esto asegura que sea solo del usuario actual
}
}
