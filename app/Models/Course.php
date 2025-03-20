<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'author'];

    /**
     * Relación con las lecciones
     * Un curso puede tener muchas lecciones
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
