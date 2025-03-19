@extends('layouts.app')

@section('title', 'Crear nuevo curso')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Crear Nuevo Curso</h1>

    @if ($errors->any())
        <div class="bg-red-200 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Título del curso:</label>
            <input type="text" name="title" class="form-control w-full border rounded p-2" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="editor" name="description" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Imagen principal:</label>
            <input type="file" name="image" class="form-control w-full border rounded p-2" required>
        </div>

        <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Crear curso</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary px-4 py-2">Cancelar</a>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('editor', {
                extraAllowedContent: 'span(*); div(*); p(*); strong; em; u; h1; h2; h3; color;',
                removePlugins: 'image,about',
                height: 300
            });
        </script>

@endsection
