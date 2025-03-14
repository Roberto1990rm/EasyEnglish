<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $table = 'lecciones'; // 🔥 Fijamos el nombre correcto de la tabla
    protected $fillable = ['title', 'description', 'image'];


    public function pronouns()
{
    return $this->hasMany(Pronoun::class, 'lesson_id');
}

}
