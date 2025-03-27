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

        <!-- Curso -->
        <div class="mb-4">
            <label class="block text-gray-700">Curso al que pertenece:</label>
            <input type="text" class="form-control w-full border rounded p-2 bg-gray-200" value="{{ $lesson->course->title }}" disabled>
        </div>

        <!-- Título -->
        <div class="mb-4">
            <label class="block text-gray-700">Título de la lección:</label>
            <input type="text" name="title" class="form-control w-full border rounded p-2" value="{{ old('title', $lesson->title) }}" required>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label class="block text-gray-700">Descripción:</label>
            <textarea name="description" id="description" class="form-control w-full border rounded p-2" rows="5">{{ old('description', $lesson->description) }}</textarea>
        </div>

        <!-- Imágenes -->
        @foreach (['image1', 'image2', 'image3'] as $img)
            <div class="mb-4">
                <label class="block text-gray-700">Imagen {{ substr($img, -1) }}:</label>
                @if ($lesson->$img)
                    <img src="{{ asset('storage/' . $lesson->$img) }}" class="w-32 h-20 object-cover rounded mb-2">
                @endif
                <input type="file" name="{{ $img }}" class="form-control w-full border rounded p-2">
            </div>
        @endforeach

        <!-- Video -->
        <div class="mb-4">
            <label class="block text-gray-700">Video (URL):</label>
            <input type="text" name="video" class="form-control w-full border rounded p-2" value="{{ old('video', $lesson->video) }}">
        </div>

        <!-- Audio -->
        <div class="mb-4">
            <label class="block text-gray-700">Audio:</label>
            @if ($lesson->audio)
                <audio controls class="w-full mb-2">
                    <source src="{{ asset('storage/' . $lesson->audio) }}" type="audio/mpeg">
                </audio>
            @endif
            <input type="file" name="audio" class="form-control w-full border rounded p-2">
        </div>

        <!-- Ejemplos dinámicos -->
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Ejemplos y traducciones</h2>
            <div id="example-container">
                @foreach ($lesson->examples as $i => $example)
                <div class="mb-4 example-group">
                    <label class="block text-gray-700">Ejemplo:</label>
                    <textarea name="examples[{{ $i }}][text]" class="form-control w-full border rounded p-2 ckeditor">{{ $example->example }}</textarea>
            
                    <label class="block text-gray-700 mt-2">Traducción:</label>
                    <textarea name="examples[{{ $i }}][translation]" class="form-control w-full border rounded p-2 ckeditor">{{ $example->translation }}</textarea>
            
                    <label class="block text-gray-700 mt-2">Palabra que se ocultará en el ejercicio:</label>
                    <input type="text" name="examples[{{ $i }}][solution]" value="{{ $example->solution }}" class="form-control w-full border rounded p-2" placeholder="Ej: is, are, run, table...">
                </div>
            @endforeach
            
            </div>

            <button type="button" onclick="addExample()" class="bg-green-500 text-white px-4 py-2 rounded">
                + Añadir otro ejemplo
            </button>
        </div>

        <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Actualizar lección</button>
        <a href="{{ route('courses.show', $lesson->course_id) }}" class="btn bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Cancelar</a>
    </form>
</div>

<!-- CKEditor y script para ejemplos -->
<script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        CKEDITOR.replace('description', {
            extraPlugins: 'colorbutton,colordialog',
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
                { name: 'insert', items: ['Link', 'Unlink'] },
                { name: 'styles', items: ['Format'] },
                { name: 'document', items: ['Source'] }
            ]
        });

        document.querySelectorAll('.ckeditor').forEach((textarea) => {
            CKEDITOR.replace(textarea, {
                extraPlugins: 'colorbutton,colordialog',
                toolbar: [
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                    { name: 'colors', items: ['TextColor', 'BGColor'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
                    { name: 'insert', items: ['Link', 'Unlink'] },
                    { name: 'styles', items: ['Format'] },
                    { name: 'document', items: ['Source'] }
                ]
            });
        });
    });

    let exampleCount = {{ $lesson->examples->count() }};

    function addExample() {
        const container = document.getElementById('example-container');
        const newGroup = document.createElement('div');
        newGroup.classList.add('mb-4', 'example-group');

        newGroup.innerHTML = `
            <label class="block text-gray-700">Ejemplo:</label>
            <textarea name="examples[\${exampleCount}][text]" class="form-control w-full border rounded p-2 ckeditor"></textarea>

            <label class="block text-gray-700 mt-2">Traducción:</label>
            <textarea name="examples[\${exampleCount}][translation]" class="form-control w-full border rounded p-2 ckeditor"></textarea>

            <label class="block text-gray-700 mt-2">Palabra a ocultar (solution):</label>
            <input type="text" name="examples[\${exampleCount}][solution]" class="form-control w-full border rounded p-2">
        `;

        container.appendChild(newGroup);

        const textareas = newGroup.querySelectorAll('.ckeditor');
        textareas.forEach((textarea) => {
            CKEDITOR.replace(textarea, {
                extraPlugins: 'colorbutton,colordialog',
                toolbar: [
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                    { name: 'colors', items: ['TextColor', 'BGColor'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
                    { name: 'insert', items: ['Link', 'Unlink'] },
                    { name: 'styles', items: ['Format'] },
                    { name: 'document', items: ['Source'] }
                ]
            });
        });

        exampleCount++;
    }
</script>

@endsection