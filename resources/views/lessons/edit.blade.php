@extends('layouts.app')

@section('title', 'Editar Lección')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Editar Lección</h1>

    @if ($errors->any())
        <div class="bg-red-200 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lessons.update', $lesson) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Curso (no editable) -->
        <div class="mb-4">
            <label class="block text-gray-700">Curso al que pertenece:</label>
            <input type="text" class="form-control w-full border rounded p-2 bg-gray-200" value="{{ $lesson->course->title }}" disabled>
        </div>

        <!-- Título -->
        <div class="mb-4">
            <label class="block text-gray-700">Título de la lección:</label>
            <input type="text" name="title" class="form-control w-full border rounded p-2" value="{{ $lesson->title }}" required>
        </div>

        <!-- Descripción con Editor -->
        <div class="mb-4">
            <label class="block text-gray-700">Descripción:</label>
            <textarea id="editor" name="description" class="form-control w-full border rounded p-2" rows="5" required>{{ $lesson->description }}</textarea>
        </div>

        <!-- Imágenes -->
        <div class="mb-4">
            <label class="block text-gray-700">Imagen 1:</label>
            @if($lesson->image1)
                <img src="{{ asset('storage/' . $lesson->image1) }}" class="w-32 h-20 object-cover rounded">
            @endif
            <input type="file" name="image1" class="form-control w-full border rounded p-2">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Imagen 2:</label>
            @if($lesson->image2)
                <img src="{{ asset('storage/' . $lesson->image2) }}" class="w-32 h-20 object-cover rounded">
            @endif
            <input type="file" name="image2" class="form-control w-full border rounded p-2">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Imagen 3:</label>
            @if($lesson->image3)
                <img src="{{ asset('storage/' . $lesson->image3) }}" class="w-32 h-20 object-cover rounded">
            @endif
            <input type="file" name="image3" class="form-control w-full border rounded p-2">
        </div>

        <!-- Video -->
        <div class="mb-4">
            <label class="block text-gray-700">Video (URL o archivo):</label>
            <input type="text" name="video" class="form-control w-full border rounded p-2" value="{{ $lesson->video }}">
        </div>

        <!-- Audio -->
        <div class="mb-4">
            <label class="block text-gray-700">Audio:</label>
            @if($lesson->audio)
                <audio controls class="w-full">
                    <source src="{{ asset('storage/' . $lesson->audio) }}" type="audio/mpeg">
                </audio>
            @endif
            <input type="file" name="audio" class="form-control w-full border rounded p-2">
        </div>

        <!-- Ejemplos y Traducciones -->
        <div class="mb-4">
            <label class="block text-gray-700">Ejemplo 1:</label>
            <input type="text" name="example1" class="form-control w-full border rounded p-2" value="{{ $lesson->example1 }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Traducción 1:</label>
            <input type="text" name="translation1" class="form-control w-full border rounded p-2" value="{{ $lesson->translation1 }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Ejemplo 2:</label>
            <input type="text" name="example2" class="form-control w-full border rounded p-2" value="{{ $lesson->example2 }}">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Traducción 2:</label>
            <input type="text" name="translation2" class="form-control w-full border rounded p-2" value="{{ $lesson->translation2 }}">
        </div>

        <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Actualizar lección</button>
        <a href="{{ route('courses.show', $lesson->course_id) }}" class="btn bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Cancelar</a>
    </form>
</div>

<!-- Editor de Texto -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>

@endsection
