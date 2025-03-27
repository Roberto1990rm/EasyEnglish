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
}
