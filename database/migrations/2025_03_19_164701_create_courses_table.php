<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::create([
            'title' => 'Curso de Laravel Básico',
            'description' => 'Aprende Laravel desde cero con este curso completo.',
            'image' => 'images/laravel_course.jpg',
            'author' => 'Juan Pérez'
        ]);

        Course::create([
            'title' => 'Curso de Vue.js Avanzado',
            'description' => 'Domina Vue.js con este curso práctico y avanzado.',
            'image' => 'images/vuejs_course.jpg',
            'author' => 'María García'
        ]);
    }
}
