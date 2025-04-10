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
            <div class="mb-4">
                <label class="block text-gray-700">Imagen 1:</label>
                <input type="file" name="image1" class="form-control w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Imagen 2:</label>
                <input type="file" name="image2" class="form-control w-full border rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Imagen 3:</label>
                <input type="file" name="image3" class="form-control w-full border rounded p-2">
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
            <div id="example-container">
                <label class="block text-gray-700 mb-2">Ejemplos y Traducciones:</label>
                
                <div class="example-group mb-4">
                    <textarea name="examples[0][text]" class="editor form-control w-full border rounded p-2 mb-2" placeholder="Ejemplo..." required></textarea>
                    <textarea name="examples[0][translation]" class="editor form-control w-full border rounded p-2" placeholder="Traducción..." required></textarea>
                </div>
            </div>
            
            <button type="button" id="add-example" class="bg-green-600 text-white px-3 py-2 rounded mb-6">
                + Añadir otro ejemplo
            </button>

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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        let exampleIndex = 1;
    
        function initEditor(selector) {
            setTimeout(() => {
                CKEDITOR.replace(selector);
            }, 100);
        }
    
        document.addEventListener('DOMContentLoaded', () => {
            CKEDITOR.replaceAll('editor');
    
            document.getElementById('add-example').addEventListener('click', () => {
                const container = document.getElementById('example-container');
    
                const group = document.createElement('div');
                group.classList.add('example-group', 'mb-4');
    
                group.innerHTML = `
                    <textarea name="examples[${exampleIndex}][text]" class="editor form-control w-full border rounded p-2 mb-2" placeholder="Ejemplo..." required></textarea>
                    <textarea name="examples[${exampleIndex}][translation]" class="editor form-control w-full border rounded p-2" placeholder="Traducción..." required></textarea>
                `;
    
                container.appendChild(group);
    
                // Iniciar CKEditor en los nuevos campos
                initEditor(`examples[${exampleIndex}][text]`);
                initEditor(`examples[${exampleIndex}][translation]`);
    
                exampleIndex++;
            });
        });
    </script>
    
@endsection
