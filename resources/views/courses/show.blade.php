@extends('layouts.app')

@section('title', $course->title)

@section('content')

<div class="container mx-auto px-4 py-8">
    <!-- Información del Curso -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h1 class="text-3xl font-bold text-gray-800">{{ $course->title }}</h1>
        <img src="{{ asset('storage/' . $course->image) }}" class="w-full h-60 object-cover rounded-md my-4" alt="{{ $course->title }}">
        <div class="prose max-w-none text-gray-700">
            {!! $course->description !!}
        </div>
        <p class="text-sm text-gray-500 mt-2">Autor: {{ $course->author }}</p>
    </div>
    <div class="text-center">
    <!-- Lista de Lecciones -->
    <h2 style="color: azure; text-shadow:black 3px 3px 6px;" class="text-2xl font-bold text-gray-800 mb-4">Lecciones del Curso</h2>
    </div>
    @if($course->lessons->isEmpty())
   
        <p class="text-gray-600">No hay lecciones disponibles para este curso aún.</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($course->lessons as $lesson)
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-bold text-blue-600">{{ $lesson->title }}</h3>
                <div class="prose max-w-none text-gray-600 mt-2">
                    {!! $lesson->description !!}
                </div>
        
                <!-- Imágenes -->
                <div class="flex space-x-2 mt-3">
                    @if($lesson->image1)
                        <img src="{{ asset('storage/' . $lesson->image1) }}" class="w-1/3 h-20 object-cover rounded">
                    @endif
                    @if($lesson->image2)
                        <img src="{{ asset('storage/' . $lesson->image2) }}" class="w-1/3 h-20 object-cover rounded">
                    @endif
                    @if($lesson->image3)
                        <img src="{{ asset('storage/' . $lesson->image3) }}" class="w-1/3 h-20 object-cover rounded">
                    @endif
                </div>
                @if($lesson->video)
                @php
                    // Extraer el ID del video de YouTube
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $lesson->video, $matches);
                    $youtubeID = $matches[1] ?? null;
                @endphp
            
                @if($youtubeID)
                    <div class="mt-4 w-full max-w-lg mx-auto">
                        <div class="relative w-full" style="padding-top: 56.25%; overflow: hidden;">
                            <iframe class="absolute top-0 left-0 w-full h-full"
                                src="https://www.youtube.com/embed/{{ $youtubeID }}"
                                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                                gyroscope; picture-in-picture; web-share" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                @else
                    <p class="text-red-500">⚠️ Video no válido</p>
                @endif
            @endif
            
            
                <!-- Audio -->
                @if($lesson->audio)
                    <div class="mt-4">
                        <audio controls class="w-full">
                            <source src="{{ asset('storage/' . $lesson->audio) }}" type="audio/mpeg">
                        </audio>
                    </div>
                @endif
        
                <!-- Ejemplos y Traducciones -->
                <div class="mt-4 p-3 bg-gray-100 rounded">
                    @if($lesson->example1)
                        <p class="text-gray-800"><strong>Ejemplo 1:</strong> {{ $lesson->example1 }}</p>
                        <p class="text-gray-600"><em>Traducción:</em> {{ $lesson->translation1 }}</p>
                    @endif
                    @if($lesson->example2)
                        <p class="text-gray-800 mt-2"><strong>Ejemplo 2:</strong> {{ $lesson->example2 }}</p>
                        <p class="text-gray-600"><em>Traducción:</em> {{ $lesson->translation2 }}</p>
                    @endif
                </div>
        
                <!-- Botones de Acción (Solo para Admins) -->
                @auth
                    @if(auth()->user()->admin)
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
    @endif
            
            

</div>

@endsection
