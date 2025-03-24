@extends('layouts.app')

@section('title', $course->title)

@section('content')

@php use Illuminate\Support\Facades\Storage; @endphp

    <div class="container mx-auto px-4 py-8">

        @auth
            @if (auth()->user()->admin == 1)
                <div style="margin-top: -20px;" class="text-center mb-4">
                    <a href="{{ route('lessons.create') }}" class="btn btn-primary px-4 py-2">
                        Crear Lección
                    </a>
                </div>
            @endif
        @endauth

        <!-- Información del Curso -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-800">{{ $course->title }}</h1>
            @php
            $imagePath = $course->image && Storage::disk('public')->exists($course->image)
                ? asset('storage/' . $course->image)
                : asset('images/default.jpg');
        @endphp
                                    <img 
                                    src="{{ $imagePath }}" 
                                    class="w-full h-40 object-cover rounded-t" 
                                    alt="{{ $course->title }}"
                                >
            <div class="prose max-w-none text-gray-700">
                {!! $course->description !!}
            </div>
            <p class="text-sm text-gray-500 mt-2">Autor: {{ $course->author }}</p>
        </div>

        <div class="bg-yellow-400 bg-opacity-90 rounded-lg shadow-md text-center py-6 px-4 mb-8">
            <h2 class="text-3xl font-extrabold text-white mb-2" style="text-shadow: 2px 2px 5px black;">
                Lecciones del Curso
            </h2>
        
            @if ($course->lessons->isEmpty())
                <p class="text-gray-100 text-lg mt-2">
                    No hay lecciones disponibles para este curso aún.
                </p>
            @endif
        </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($course->lessons as $lesson)
                    <div id="lesson-{{ $lesson->id }}" class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-xl font-bold text-blue-600">{{ $lesson->title }}</h3>
                        <div class="prose max-w-none text-gray-600 mt-2">
                            {!! $lesson->description !!}
                        </div>

                        <!-- Imágenes -->
                        <div class="flex space-x-2 mt-3">
                            @if ($lesson->image1)
                                <img src="{{ asset('storage/' . $lesson->image1) }}"
                                    class="w-1/3 h-20 object-cover rounded cursor-pointer"
                                    onclick="openModal('{{ asset('storage/' . $lesson->image1) }}')">
                            @endif
                            @if ($lesson->image2)
                                <img src="{{ asset('storage/' . $lesson->image2) }}"
                                    class="w-1/3 h-20 object-cover rounded cursor-pointer"
                                    onclick="openModal('{{ asset('storage/' . $lesson->image2) }}')">
                            @endif
                            @if ($lesson->image3)
                                <img src="{{ asset('storage/' . $lesson->image3) }}"
                                    class="w-1/3 h-20 object-cover rounded cursor-pointer"
                                    onclick="openModal('{{ asset('storage/' . $lesson->image3) }}')">
                            @endif
                        </div>
                        @if ($lesson->video)
                            @php
                                // Extraer el ID del video de YouTube
                                preg_match(
                                    '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i',
                                    $lesson->video,
                                    $matches,
                                );
                                $youtubeID = $matches[1] ?? null;
                            @endphp

                            @if ($youtubeID)
                                <div class="mt-4 w-full max-w-lg mx-auto">
                                    <div class="relative w-full" style="padding-top: 56.25%; overflow: hidden;">
                                        <iframe class="absolute top-0 left-0 w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $youtubeID }}" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                                gyroscope; picture-in-picture; web-share"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            @else
                                <p class="text-red-500">⚠️ Video no válido</p>
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

                        <!-- Ejemplos y Traducciones -->
                        <div class="mt-4 p-3 bg-gray-100 rounded">
                            @if ($lesson->example1)
                                <p class="text-gray-800"><strong>Ejemplo 1:</strong> {{ $lesson->example1 }}</p>
                                <p class="text-gray-600"><em>Traducción:</em> {{ $lesson->translation1 }}</p>
                            @endif
                            @if ($lesson->example2)
                                <p class="text-gray-800 mt-2"><strong>Ejemplo 2:</strong> {{ $lesson->example2 }}</p>
                                <p class="text-gray-600"><em>Traducción:</em> {{ $lesson->translation2 }}</p>
                            @endif
                        </div>

                        <!-- Botones de Acción (Solo para Admins) -->
                        @auth
                            @if (auth()->user()->admin)
                                <div class="mt-4 flex space-x-3">
                                    <!-- Botón Editar -->
                                    <a href="{{ route('lessons.edit', $lesson->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>

                                    <!-- Botón Eliminar -->
                                    <form action="{{ route('lessons.destroy', $lesson) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta lección?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                @endforeach

        <div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-80">
            <div class="relative max-w-4xl mx-auto">
                <button onclick="closeModal()"
                    class="absolute top-2 right-2 text-black text-3xl font-bold hover:text-red-500">&times;</button>
                <img id="modalImage" src="" class="max-w-full max-h-[80vh] mx-auto rounded-lg shadow-lg"
                    alt="Imagen ampliada">
            </div>
        </div>

    </div>



    <div class="text-center mt-8">
        <a href="{{ route('courses.index') }}"
           class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
            <i class="bi bi-arrow-left-circle-fill mr-2 text-xl"></i>
            Volver a Cursos
        </a>
    </div>
@endsection




<script>
    function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
        document.getElementById('imageModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.remove('flex');
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Cerrar modal al hacer clic fuera de la imagen
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
