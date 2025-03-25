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

        // Lección 1: To Be
        $lesson1 = Lesson::create([
            'course_id' => $course->id,
            'user_id' => 1,
            'title' => 'El verbo "to be"',
            'description' => '
                <p>El verbo <strong>"to be"</strong> es uno de los más importantes en inglés. Se traduce como <em>"ser" o "estar"</em> y se usa para describir identidad, estado, profesión, edad y más.</p>
                
                <h3>Forma del verbo "to be" en presente:</h3>
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse: collapse;" border="1" cellpadding="6">
                        <thead style="background-color: #f3f3f3;">
                            <tr>
                                <th>Pronombre</th>
                                <th>Traducción</th>
                                <th><strong>Verbo "to be"</strong></th>
                                <th>Traducción</th>
                                <th>Ejemplo</th>
                                <th>Traducción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><strong>I</strong></td><td>Yo</td><td style="color: red;">am</td><td>soy / estoy</td><td>I <span style="color:blue;">am</span> a teacher.</td><td><strong>Soy</strong> profesor.</td></tr>
                            <tr><td><strong>You</strong></td><td>Tú</td><td style="color: red;">are</td><td>eres / estás</td><td>You <span style="color:blue;">are</span> happy.</td><td><strong>Estás</strong> feliz.</td></tr>
                            <tr><td><strong>He</strong></td><td>Él</td><td style="color: red;">is</td><td>es / está</td><td>He <span style="color:blue;">is</span> tall.</td><td><strong>Es</strong> alto.</td></tr>
                            <tr><td><strong>She</strong></td><td>Ella</td><td style="color: red;">is</td><td>es / está</td><td>She <span style="color:blue;">is</span> a doctor.</td><td><strong>Es</strong> doctora.</td></tr>
                            <tr><td><strong>It</strong></td><td>Eso</td><td style="color: red;">is</td><td>es / está</td><td>It <span style="color:blue;">is</span> cold.</td><td><strong>Está</strong> frío.</td></tr>
                            <tr><td><strong>We</strong></td><td>Nosotros</td><td style="color: red;">are</td><td>somos / estamos</td><td>We <span style="color:blue;">are</span> friends.</td><td><strong>Somos</strong> amigos.</td></tr>
                            <tr><td><strong>They</strong></td><td>Ellos</td><td style="color: red;">are</td><td>son / están</td><td>They <span style="color:blue;">are</span> students.</td><td><strong>Son</strong> estudiantes.</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="mt-3">El verbo "to be" también se usa para describir ubicaciones y emociones.</p>
            ',
            'video' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/KRyK79yP0oA?si=WHI56pnnzPyw76AD" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
        ]);

        $examples1 = [
            ['example' => 'I <span style="color:blue;">am</span> tired.', 'translation' => 'Estoy <strong>cansado</strong>.'],
            ['example' => 'She <span style="color:blue;">is</span> at home.', 'translation' => 'Ella <strong>está</strong> en casa.'],
            ['example' => 'They <span style="color:blue;">are</span> my friends.', 'translation' => 'Ellos <strong>son</strong> mis amigos.'],
            ['example' => 'It <span style="color:blue;">is</span> a beautiful day.', 'translation' => '<strong>Es</strong> un día hermoso.'],
            ['example' => 'We <span style="color:blue;">are</span> ready.', 'translation' => '<strong>Estamos</strong> listos.'],
        ];

        foreach ($examples1 as $item) {
            $lesson1->examples()->create($item);
        }

        // Lección 2: Pronombres Personales
        $lesson2 = Lesson::create([
            'course_id' => $course->id,
            'user_id' => 1,
            'title' => 'Pronombres Personales (Personal Pronouns)',
            'description' => '
                <p>Los pronombres personales son palabras que sustituyen a los nombres para evitar repeticiones y facilitar la comunicación.</p>
                
                <h3>Tabla de Pronombres Personales:</h3>
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse: collapse;" border="1" cellpadding="6">
                        <thead style="background-color: #f3f3f3;">
                            <tr>
                                <th>Inglés</th>
                                <th>Español</th>
                                <th>Ejemplo</th>
                                <th>Traducción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>I</td><td>Yo</td><td><span style="color:blue;">I</span> like coffee.</td><td><strong>Yo</strong> gusto del café.</td></tr>
                            <tr><td>You</td><td>Tú / Usted</td><td><span style="color:blue;">You</span> are smart.</td><td><strong>Tú</strong> eres inteligente.</td></tr>
                            <tr><td>He</td><td>Él</td><td><span style="color:blue;">He</span> works in a bank.</td><td><strong>Él</strong> trabaja en un banco.</td></tr>
                            <tr><td>She</td><td>Ella</td><td><span style="color:blue;">She</span> dances well.</td><td><strong>Ella</strong> baila bien.</td></tr>
                            <tr><td>It</td><td>Eso</td><td><span style="color:blue;">It</span> is raining.</td><td><strong>Está</strong> lloviendo.</td></tr>
                            <tr><td>We</td><td>Nosotros / Nosotras</td><td><span style="color:blue;">We</span> live in Spain.</td><td><strong>Nosotros</strong> vivimos en España.</td></tr>
                            <tr><td>They</td><td>Ellos / Ellas</td><td><span style="color:blue;">They</span> play soccer.</td><td><strong>Ellos</strong> juegan fútbol.</td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="mt-3">Los pronombres personales son fundamentales para formar frases correctamente en inglés.</p>
            ',
            'video' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/D0RgdfHXFKE?si=KeI48LRqMcMWaIo0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
        ]);

        $examples2 = [
            ['example' => '<span style="color:blue;">He</span> is my brother.', 'translation' => '<strong>Él</strong> es mi hermano.'],
            ['example' => '<span style="color:blue;">We</span> are students.', 'translation' => '<strong>Nosotros</strong> somos estudiantes.'],
            ['example' => '<span style="color:blue;">It</span> is a cat.', 'translation' => '<strong>Es</strong> un gato.'],
            ['example' => '<span style="color:blue;">You</span> are my friend.', 'translation' => '<strong>Eres</strong> mi amigo.'],
        ];

        foreach ($examples2 as $item) {
            $lesson2->examples()->create($item);
        }


        // ... (todo tu código anterior)

// Lección 3: Artículos definidos e indefinidos
$lesson3 = Lesson::create([
    'course_id' => $course->id,
    'user_id' => 1,
    'title' => 'Artículos definidos e indefinidos',
    'description' => '
        <p>Los artículos en inglés son <strong>"a", "an"</strong> (indefinidos) y <strong>"the"</strong> (definido).</p>
        <ul>
            <li><strong>a</strong> se usa antes de palabras que comienzan con sonido consonántico: <em>a dog</em></li>
            <li><strong>an</strong> se usa antes de palabras que comienzan con sonido vocálico: <em>an apple</em></li>
            <li><strong>the</strong> se usa para referirse a algo específico o ya mencionado: <em>the book</em></li>
        </ul>
    ',
    'video' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/kDdTgxv04n4" title="YouTube video player" frameborder="0" allowfullscreen></iframe>',
]);

$examples3 = [
    ['example' => 'I saw <span style="color:blue;">a</span> bird.', 'translation' => 'Vi <strong>un</strong> pájaro.'],
    ['example' => 'She has <span style="color:blue;">an</span> idea.', 'translation' => 'Ella tiene <strong>una</strong> idea.'],
    ['example' => 'Please open <span style="color:blue;">the</span> window.', 'translation' => 'Por favor abre <strong>la</strong> ventana.'],
];

foreach ($examples3 as $item) {
    $lesson3->examples()->create($item);
}

// Segundo Curso: Vocabulario Esencial
$course2 = Course::create([
    'title' => 'Vocabulario Esencial',
    'description' => 'Aprende palabras clave y expresiones para comunicarte desde el primer día.',
    'image' => 'images/default.jpg',
    'author' => 'Admin',
]);

// Lección 1: Saludos
$lesson4 = Lesson::create([
    'course_id' => $course2->id,
    'user_id' => 1,
    'title' => 'Saludos en inglés',
    'description' => '
        <p>Los saludos son fundamentales para empezar una conversación:</p>
        <ul>
            <li><strong>Hello</strong> – Hola</li>
            <li><strong>Good morning</strong> – Buenos días</li>
            <li><strong>Good afternoon</strong> – Buenas tardes</li>
            <li><strong>Good evening</strong> – Buenas noches (al llegar)</li>
            <li><strong>Goodbye</strong> – Adiós</li>
        </ul>
    ',
    'video' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/o6kU8VeuA5c" title="YouTube video player" frameborder="0" allowfullscreen></iframe>',
]);

$examples4 = [
    ['example' => '<span style="color:blue;">Hello</span>, how are you?', 'translation' => '<strong>Hola</strong>, ¿cómo estás?'],
    ['example' => '<span style="color:blue;">Good morning</span>, class.', 'translation' => '<strong>Buenos días</strong>, clase.'],
];

// Lección 2: Colores
$lesson5 = Lesson::create([
    'course_id' => $course2->id,
    'user_id' => 1,
    'title' => 'Colores básicos',
    'description' => '
        <p>Aprender los colores te permite describir objetos:</p>
        <ul>
            <li><strong>Red</strong> – Rojo</li>
            <li><strong>Blue</strong> – Azul</li>
            <li><strong>Green</strong> – Verde</li>
            <li><strong>Yellow</strong> – Amarillo</li>
            <li><strong>Black</strong> – Negro</li>
        </ul>
    ',
    'video' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/R7WMDsZ4Gyc" title="YouTube video player" frameborder="0" allowfullscreen></iframe>',
]);

$examples5 = [
    ['example' => 'The car is <span style="color:blue;">red</span>.', 'translation' => 'El coche es <strong>rojo</strong>.'],
    ['example' => 'I like <span style="color:blue;">blue</span>.', 'translation' => 'Me gusta el <strong>azul</strong>.'],
];

// Lección 3: Números del 1 al 10
$lesson6 = Lesson::create([
    'course_id' => $course2->id,
    'user_id' => 1,
    'title' => 'Números del 1 al 10',
    'description' => '
        <p>Los números básicos son esenciales para contar y entender cantidades:</p>
        <p><strong>One, Two, Three, Four, Five, Six, Seven, Eight, Nine, Ten</strong></p>
    ',
    'video' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/DR-cfDsHCGA" title="YouTube video player" frameborder="0" allowfullscreen></iframe>',
]);

$examples6 = [
    ['example' => 'I have <span style="color:blue;">three</span> dogs.', 'translation' => 'Tengo <strong>tres</strong> perros.'],
    ['example' => 'She is <span style="color:blue;">five</span> years old.', 'translation' => 'Ella tiene <strong>cinco</strong> años.'],
];

// Asociar ejemplos
foreach ($examples4 as $item) {
    $lesson4->examples()->create($item);
}
foreach ($examples5 as $item) {
    $lesson5->examples()->create($item);
}
foreach ($examples6 as $item) {
    $lesson6->examples()->create($item);
}

    }
}
