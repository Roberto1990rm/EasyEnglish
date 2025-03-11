@extends('layouts.app')

@section('content')
<div class="container mt-5" style="padding-bottom: 100px;">
    <h2 class="text-center">Crear Pronombre para "{{ $leccion->title }}"</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pronouns.store', $leccion->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="pronoun" class="form-label">Pronombre</label>
            <input type="text" class="form-control" id="pronoun" name="pronoun">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="translation" class="form-label">Traducción</label>
            <input type="text" class="form-control" id="translation" name="translation">
        </div>

        <div class="mb-3">
            <label for="example_1" class="form-label">Ejemplo 1</label>
            <input type="text" class="form-control" id="example_1" name="example_1">
        </div>

        <div class="mb-3">
            <label for="example_2" class="form-label">Ejemplo 2</label>
            <input type="text" class="form-control" id="example_2" name="example_2">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="video" class="form-label">Video</label>
            <input type="file" class="form-control" id="video" name="video" accept="video/*">
        </div>

        <div class="mb-3">
            <label for="audio" class="form-label">Audio</label>
            <input type="file" class="form-control" id="audio" name="audio" accept="audio/*">
        </div>

        <button type="submit" class="btn btn-success">Guardar Pronombre</button>
        <a href="{{ route('curso.basico.show', $leccion->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
