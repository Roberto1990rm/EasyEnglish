@extends('layouts.app')

@section('content')
<div  class="mt-5">
    <h1 class="p1Home text-center">Curso Básico</h1>

    @auth
    
    <div class="text-center">
        <a href="{{ route('curso_basico.create') }}" class="btn btn-primary mb-3">Crear Nueva Lección</a>
    </div>
    @endauth
       
    <div class="row">
        @foreach($lecciones as $leccion)
            <div class="col-md-4">
                <div class="card mb-4 ms-2">
                    <img src="{{ asset('storage/' . $leccion->image) }}" class="card-img-top" alt="{{ $leccion->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $leccion['title'] }}</h5>
                        <p class="card-text">{{ $leccion['description'] }}</p>
                        <a href="{{ route('curso.basico.show', $leccion['id']) }}" class="btn btn-primary">Ver más</a>
                    </div>

                    <div class="ms-3 mb-1">
                     <!-- Botón de eliminar -->
                <form action="{{ route('curso.basico.destroy', $leccion->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta lección?');">
                        Eliminar
                    </button>
                </form>
            </div>
                </div>
                
            </div>
        @endforeach
    </div>

    <div class="text-center">
    <a href="{{ url('/') }}" class="btn btn-info">
        <i class="fas fa-home"></i> Inicio
    </a>
</div>

</div>
@endsection