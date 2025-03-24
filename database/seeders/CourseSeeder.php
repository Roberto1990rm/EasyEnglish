<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $course1 = Course::create([
            'title' => 'Inglés Básico',
            'description' => 'Un curso introductorio para comenzar tu viaje con el inglés.',
            'image' => 'images/default.jpg',
            'author' => 'Admin',
        ]);

        $course2 = Course::create([
            'title' => 'Inglés Intermedio',
            'description' => 'Mejora tu gramática y vocabulario en inglés.',
            'image' => 'images/default.jpg',
            'author' => 'Admin',
        ]);

        // Lecciones para el curso 1
        Lesson::create([
            'course_id' => $course1->id,
            'title' => 'Saludos y Presentaciones',
            'description' => 'Aprende a saludar y presentarte en inglés.',
            'user_id' => 1,
            'video' => 'https://www.youtube.com/watch?v=abcd1234',
            'example1' => 'Hello, my name is John.',
            'translation1' => 'Hola, mi nombre es John.',
        ]);

        Lesson::create([
            'course_id' => $course1->id,
            'title' => 'Números y Colores',
            'description' => 'Vocabulario básico de números y colores.',
            'user_id' => 1,
            'video' => 'https://www.youtube.com/watch?v=efgh5678',
            'example1' => 'The sky is blue.',
            'translation1' => 'El cielo es azul.',
        ]);

        // Lecciones para el curso 2
        Lesson::create([
            'course_id' => $course2->id,
            'title' => 'Tiempos Verbales',
            'description' => 'Presente simple, pasado simple y futuro.',
            'user_id' => 1,
            'video' => 'https://www.youtube.com/watch?v=ijkl9012',
            'example1' => 'I study English every day.',
            'translation1' => 'Estudio inglés todos los días.',
        ]);

        Lesson::create([
            'course_id' => $course2->id,
            'title' => 'Conversación Básica',
            'description' => 'Frases comunes en diálogos cotidianos.',
            'user_id' => 1,
            'video' => 'https://www.youtube.com/watch?v=mnop3456',
            'example1' => 'How are you?',
            'translation1' => '¿Cómo estás?',
        ]);
    }
}
