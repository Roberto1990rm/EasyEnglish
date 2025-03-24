<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Example;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::create([
            'title' => 'Gramática Fundamental',
            'description' => 'Aprende la base del inglés con lecciones claras y prácticas.',
            'image' => 'images/default.jpg',
            'author' => 'Admin',
        ]);

        $lesson = Lesson::create([
            'course_id' => $course->id,
            'user_id' => 1,
            'title' => 'El verbo "to be"',
            'description' => '
                <p>El verbo <strong>"to be"</strong> es uno de los más importantes en inglés. Se traduce como <em>"ser" o "estar"</em> y se usa para describir identidad, estado, profesión, edad y más.</p>
                
                <h3>Forma del verbo "to be" en presente:</h3>
                <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="6">
                    <thead>
                        <tr style="background-color: #f3f3f3;">
                            <th>Pronombre</th>
                            <th>Verbo "to be"</th>
                            <th>Ejemplo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>I</td><td>am</td><td>I am a teacher.</td></tr>
                        <tr><td>You</td><td>are</td><td>You are happy.</td></tr>
                        <tr><td>He</td><td>is</td><td>He is tall.</td></tr>
                        <tr><td>She</td><td>is</td><td>She is a doctor.</td></tr>
                        <tr><td>It</td><td>is</td><td>It is cold.</td></tr>
                        <tr><td>We</td><td>are</td><td>We are friends.</td></tr>
                        <tr><td>They</td><td>are</td><td>They are students.</td></tr>
                    </tbody>
                </table>
                <p>También se usa para describir ubicaciones y emociones.</p>
            ',
            'video' => 'https://www.youtube.com/watch?v=2e4v4zZy3uY',
        ]);

        $examples = [
            ['example' => 'I am tired.', 'translation' => 'Estoy cansado.'],
            ['example' => 'She is at home.', 'translation' => 'Ella está en casa.'],
            ['example' => 'They are my friends.', 'translation' => 'Ellos son mis amigos.'],
            ['example' => 'It is a beautiful day.', 'translation' => 'Es un día hermoso.'],
            ['example' => 'We are ready.', 'translation' => 'Estamos listos.'],
        ];

        foreach ($examples as $item) {
            $lesson->examples()->create($item);
        }
    }
}
