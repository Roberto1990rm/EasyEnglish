<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pronoun extends Model
{
    use HasFactory;

    protected $fillable = ['lesson_id', 'pronoun', 'image', 'video', 'audio', 'description', 'translation', 'example_1', 'example_2'];

    public function lesson()
    {
        return $this->belongsTo(Leccion::class, 'lesson_id');
    }
}
