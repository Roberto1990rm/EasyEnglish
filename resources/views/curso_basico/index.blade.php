@extends('layouts.app')

@section('content')
<div class="mt-5">
    <h1 class="p1Home text-center mt-5">Curso Básico</h1>

    @auth
    <div class="text-center mt-5 mb-5">
        <a href="{{ route('curso_basico.create') }}" class="btn btn-primary mb-3">Crear Nueva Lección</a>
    </div>
    @endauth
       
    <!-- Contenedor con padding horizontal para separar del borde -->
    <div class="container px-5 mt-5">
        <div class="row">
            @foreach($lecciones as $leccion)
                <div class="col-md-4">
                    <div style="color: black" class="card mb-4 ms-2">
                        <img style="height: 170px;" src="{{ asset('storage/' . $leccion->image) }}" class="card-img-top" alt="{{ $leccion->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $leccion['title'] }}</h5>
                            <p class="card-text1">{{ $leccion['description'] }}</p>
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Botón "Ver más" como icono -->
                                <a href="{{ route('curso.basico.show', $leccion['id']) }}" class="btn btn-primary btn-sm" title="Ver más">
                                    <i class="fas fa-eye"></i>
                                </a>
                        
                                <!-- Botón "Eliminar" como icono -->
                                <form action="{{ route('curso.basico.destroy', $leccion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta lección?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
<div class="text-center mt-2">
    <a href="{{ url('/') }}" style="background-color: azure" class="mt-5 btn btn-outline-primary" title="Volver al Home">
        <i class="bi bi-house-fill fs-3"></i>
    </a>
</div>   
</div>
@endsection

