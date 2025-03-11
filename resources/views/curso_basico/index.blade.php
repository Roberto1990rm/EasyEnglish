@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Curso Básico</h1>
    <div class="row">
        <a href="{{ route('curso_basico.create') }}" class="btn btn-primary">Crear Nueva Lección</a>
        @foreach($lecciones as $leccion)
            <div class="col-md-4">
                
                <div class="card mb-4">
                    <img src="{{ asset('images/' . $leccion['image']) }}" class="card-img-top" alt="{{ $leccion['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $leccion['title'] }}</h5>
                        <p class="card-text">{{ $leccion['description'] }}</p>
                        <a href="{{ route('curso.basico.show', $leccion['id']) }}" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection