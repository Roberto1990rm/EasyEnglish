@extends('layouts.app')

@section('title', $course->title)

@section('content')
    @php use Illuminate\Support\Facades\Storage; @endphp

    <div class="container mx-auto px-0 py-10">
        @auth
            @if (auth()->user()->admin)
                <div class="text-center mb-4">
                    <a href="{{ route('lessons.create') }}" class="btn btn-primary px-4 py-2">
                        Crear Lección
                    </a>
                </div>
            @endif
        @endauth

        <!-- Información del Curso -->
        <div class="bg-white shadow-md rounded-lg  mb-8 text-center pt-3 pb-3">
            <h1 class="text-3xl font-bold text-gray-800">{{ $course->title }}</h1>
            @php
            $imagePath =
                $course->image && Storage::disk('public')->exists($course->image)
                    ? asset('storage/' . $course->image)
                    : asset('images/default.jpg');
        @endphp

            <img src="{{ $imagePath }}" class="w-50 h-50 object-cover rounded-t my-4 block mx-auto"
                alt="{{ $course->title }}">

            <div class="  text-gray-700">
                {!! $course->description !!}
            </div>
            <p class="text-sm text-gray-500 mt-2">Autor: {{ $course->author }}</p>
            
            @php
                use App\Models\Lesson;

                $userId = auth()->id();
                $totalLessons = $course->lessons->count();

                $completedLessons = Lesson::whereHas('exerciseResults', function ($q) use ($userId) {
                    $q->where('user_id', $userId)->where('completed', true);
                })
                    ->where('course_id', $course->id)
                    ->count();

                $percentage = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;
            @endphp



            @auth
            <div class="mt-4 text-center">
                <p class="text-gray-600 mb-2">Progreso del curso</p>
                <div class="flex justify-center items-center space-x-2">
                    @for ($i = 0; $i < $totalLessons; $i++)
                        <div class="w-5 h-5 rounded-full {{ $i < $completedLessons ? 'bg-blue-500' : 'bg-gray-300' }}">
                        </div>
                    @endfor
                    <div class="text-xl ml-2">🏃</div>
                </div>
                <p class="text-sm text-gray-500 mt-1">{{ round($percentage) }}% completado ({{ $completedLessons }} de
                    {{ $totalLessons }})</p>
            </div>
            @endauth

            
            @php
                use App\Models\ExerciseResult;

                $userId = auth()->id();
                $totalLessons = $course->lessons->count();

                $completedLessons = \App\Models\Lesson::whereHas('exerciseResults', function ($q) use ($userId) {
                    $q->where('user_id', $userId)->where('completed', true);
                })
                    ->where('course_id', $course->id)
                    ->count();

                $percentage = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;
            @endphp

        </div>

        <!-- Título de lecciones -->
        <div class="bg-yellow-400 bg-opacity-90 rounded-lg shadow-md text-center py-2 px-4 mb-8">
            <h2 class="text-3xl font-extrabold text-white mb-2" style="text-shadow: 2px 2px 5px black;">
                Lecciones del Curso
            </h2>
            @if ($course->lessons->isEmpty())
                <p class="text-gray-100 text-lg mt-2">No hay lecciones disponibles para este curso aún.</p>
            @endif
        </div>

        <!-- Navegador de Lecciones -->
        <div class="flex flex-wrap justify-center gap-2 mb-6 px-4">
            @foreach ($course->lessons as $index => $lesson)
                <button onclick="goToSlide({{ $index }})"
                    class="px-4 py-1 rounded-full text-white text-sm font-semibold transition whitespace-nowrap hover:scale-105"
                    style="background-color: hsl({{ $index * 45 }}, 80%, 50%)" title="Ir a {{ $lesson->title }}">
                    {{ Str::limit($lesson->title, 20) }}
                </button>
            @endforeach
        </div>

        <!-- Carrusel de Lecciones -->
        <div class="relative  text-center" id="lesson-carousel">
            <div id="carousel-wrapper" class="overflow-hidden transition-all duration-500 ease-in-out relative">
                <div id="carousel-track" class="flex transition-transform duration-500 ease-in-out">
                    @php
                        $isSubscribed = auth()->check() && auth()->user()->subscriber;
                    @endphp

                    @foreach ($course->lessons as $index => $lesson)
                        @php
                            $canView = $isSubscribed || $index === 0;
                        @endphp

                        <div class="min-w-full px-4 box-border relative">
                            <div class="bg-white shadow-md rounded-lg p-6 {{ !$canView ? 'opacity-30 blur-sm pointer-events-none select-none' : '' }}"
                                x-data="{ showExercise: false }">
                                <div x-show="!showExercise">
                                    <h3 class="text-xl font-bold text-blue-600">{{ $lesson->title }}</h3>

                                    <div class="lesson-description overflow-x-auto mt-4 text-gray-700">
                                        {!! $lesson->description !!}
                                    </div>

                                    <!-- Imágenes -->
                                    <div class="flex space-x-2 mt-3">
                                        @foreach (['image1', 'image2', 'image3'] as $img)
                                            @if ($lesson->$img)
                                                <img src="{{ asset('storage/' . $lesson->$img) }}"
                                                    class="w-1/3 h-20 object-cover rounded cursor-pointer"
                                                    onclick="openModal('{{ asset('storage/' . $lesson->$img) }}')">
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Video -->
                                    @if ($lesson->video)
                                        @php
                                            preg_match(
                                                '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i',
                                                $lesson->video,
                                                $matches,
                                            );
                                            $youtubeID = $matches[1] ?? null;
                                        @endphp

                                        @if ($youtubeID)
                                            <div class="mt-4 w-full max-w-lg mx-auto">
                                                <div class="relative w-full" style="padding-top: 56.25%;">
                                                    <iframe class="absolute top-0 left-0 w-full h-full rounded"
                                                        src="https://www.youtube.com/embed/{{ $youtubeID }}"
                                                        frameborder="0"
                                                        allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                    <!-- Audio -->
                                    @if ($lesson->audio)
                                        <div class="mt-4">
                                            <audio controls class="w-full">
                                                <source src="{{ asset('storage/' . $lesson->audio) }}" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    @endif

                                    <!-- Ejemplos -->
                                    @if ($lesson->examples->count())
                                        <div class="mt-4 p-4 bg-gray-100 rounded">
                                            @foreach ($lesson->examples as $example)
                                                <div class="mb-3">
                                                    <p class="text-gray-800 font-semibold">Ejemplo:</p>
                                                    <div class="prose text-gray-800">{!! $example->example !!}</div>
                                                    <p class="text-gray-600 mt-1"><em>Traducción:</em>
                                                        {!! $example->translation !!}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                @auth

                                    <div x-show="showExercise">
                                        @livewire('exercises', ['lesson' => $lesson], key('exercise-' . $lesson->id))
                                    </div>


                                    <div class="mt-4 flex justify-center gap-4">
                                        <button @click="showExercise = false"
                                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Lección</button>
                                        <button @click="showExercise = true"
                                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Ejercicios</button>
                                    </div>

                                @endauth


                                <!-- Acciones (editar/eliminar) -->
                                @auth
                                    @if (auth()->user()->admin)
                                        <div class="mt-4 flex justify-center gap-4">
                                            <a href="{{ route('lessons.edit', $lesson->id) }}"
                                                class="text-blue-600 hover:text-blue-800">
                                                <i class="bi bi-pencil-square text-xl"></i>
                                            </a>
                                            <form action="{{ route('lessons.destroy', $lesson) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar esta lección?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    <i class="bi bi-trash text-xl"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            @if (!$canView)
                                <a href="{{ auth()->check() ? route('subscribe') : route('login') }}"
                                    class="absolute inset-0 flex items-center justify-center z-10">
                                    <div class="absolute inset-0 bg-opacity-60 rounded-lg "></div>
                                    <span class="text-red-500 text-2xl font-bold z-20">
                                        🔒
                                        {{ auth()->check() ? 'Suscríbete para visualizar' : 'Inicia sesión para acceder' }}
                                    </span>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <button id="prevBtn"
                class="absolute left-0 top-1/2 transform -translate-y-1/2  p-2 rounded-full shadow hover:bg-gray-100 z-10">
                <i class="bi bi-chevron-left text-2xl text-black-900"></i>
            </button>
            <button id="nextBtn"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-grey p-2 rounded-full shadow hover:bg-gray-100 z-10">
                <i class="bi bi-chevron-right text-2xl text-black-900"></i>
            </button>
        </div>

        <div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-80">
            <div class="relative max-w-4xl mx-auto">
                <button onclick="closeModal()"
                    class="absolute top-2 right-2 text-white text-3xl font-bold hover:text-red-500">&times;</button>
                <img id="modalImage" src="" class="max-w-full max-h-[80vh] mx-auto rounded-lg shadow-lg"
                    alt="Imagen ampliada">
            </div>
        </div>

        <div class="text-center mt-8 mb-6">
            <a href="{{ route('courses.index') }}"
                class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                <i class="bi bi-arrow-left-circle-fill mr-2 text-xl"></i> Cursos
            </a>
        </div>
    </div>

    <script>
        let currentIndex = 0;
        const track = document.getElementById('carousel-track');
        const cards = track.children;
        const total = cards.length;

        function updateCarousel() {
            const width = cards[0].offsetWidth;
            track.style.transform = `translateX(-${currentIndex * width}px)`;
            const currentCard = cards[currentIndex];
            document.getElementById('carousel-wrapper').style.height = currentCard.offsetHeight + 'px';
        }

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentIndex < total - 1) {
                currentIndex++;
                updateCarousel();
            }
        });

        window.addEventListener('load', updateCarousel);
        window.addEventListener('resize', updateCarousel);

        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.remove('flex');
            document.getElementById('imageModal').classList.add('hidden');
        }

        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        function goToSlide(index) {
            currentIndex = index;
            updateCarousel();
        }
    </script>

    <style>
        .lesson-description table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .lesson-description th,
        .lesson-description td {
            border: 1px solid #d1d5db;
            padding: 0.5rem 0.75rem;
            text-align: left;
            vertical-align: top;
        }

        .lesson-description th {
            background-color: #f9fafb;
            font-weight: 600;
        }

        .lesson-description tr:nth-child(even) {
            background-color: #f3f4f6;
        }
    </style>
@endsection
