@extends('layouts.app')

@section('title', 'Crear Nueva Lección')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <div style="margin-top: -20px;" class="text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Crear Lección</h1>
        </div>
        @if ($errors->any())
            <div class="bg-red-200 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <!-- Seleccionar Curso -->
            <div class="mb-4">
                <label class="block text-gray-700">Curso al que pertenece:</label>
                <select name="course_id" class="form-control w-full border rounded p-2" required>
                    <option value="" disabled selected>Seleccione un curso</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Título -->
            <div class="mb-4">
                <label class="block text-gray-700">Título de la lección:</label>
                <input type="text" name="title" class="form-control w-full border rounded p-2"
                    value="{{ old('title') }}" required>
            </div>

            <!-- Descripción con Editor de Texto -->
            <div class="mb-4">
                <label class="block text-gray-700">Descripción:</label>
                <textarea id="editor" name="description" class="form-control w-full border rounded p-2" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <!-- Imágenes -->
            <!-- Imágenes -->
            <div class="mb-4">
                <label class="block text-gray-700">Imagen 1:</label>
                <input type="file" name="image1" accept="image/*" capture="environment"
                    class="form-control w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Imagen 2:</label>
                <input type="file" name="image2" accept="image/*" capture="environment"
                    class="form-control w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Imagen 3:</label>
                <input type="file" name="image3" accept="image/*" capture="environment"
                    class="form-control w-full border rounded p-2">
            </div>


            <!-- Video -->
            <div class="mb-4">
                <label class="block text-gray-700">Video (URL o archivo):</label>
                <input type="text" name="video" class="form-control w-full border rounded p-2"
                    placeholder="Pega la URL del video">
            </div>

            <!-- Audio -->
            <div class="mb-4">
                <label class="block text-gray-700">Audio:</label>
                <input type="file" name="audio" class="form-control w-full border rounded p-2">
            </div>

            <!-- Ejemplos y Traducciones -->
            <div class="mb-4">
                <label class="block text-gray-700">Ejemplo 1:</label>
                <input type="text" name="example1" class="form-control w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Traducción 1:</label>
                <input type="text" name="translation1" class="form-control w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Ejemplo 2:</label>
                <input type="text" name="example2" class="form-control w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Traducción 2:</label>
                <input type="text" name="translation2" class="form-control w-full border rounded p-2">
            </div>

            <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Crear
                lección</button>
            <a href="{{ route('courses.index') }}"
                class="btn bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Cancelar</a>
        </form>
    </div>

    <!-- Editor de texto -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endsection
