@extends('layouts.app')

@section('content')
<div class="dynamic-layout container px-5 mt-5 mb-5">
    <!-- Contenedor de Post-it: tres cards en la misma fila -->
    <div class="postit-container mb-5">
        
        <!-- Post-it 1: Sobre el Curso -->
        <div class="mobile-only postit-item">
            <div class="postit-description" style="background-color: #fffae6; border-color: #f0e68c;">
                <h2 class="postit-title">Sobre el Curso</h2>
                <p class="postit-text">
                    Este curso está diseñado para transformar tu forma de aprender inglés con métodos interactivos y divertidos.
                </p>
            </div>
        </div>
        <!-- Post-it 2: Objetivos -->
        <div class="postit-item">
            <div class="postit-description" style="background-color: #e0f7fa; border-color: #4dd0e1;">
                <h2 class="postit-title">Objetivos</h2>
                <p class="postit-text">
                    Mejorar tu fluidez y comprensión mediante ejercicios prácticos y actividades dinámicas.
                </p>
            </div>
        </div>
        <!-- Post-it 3: Beneficios -->
        <div class="postit-item">
            <div class="postit-description" style="background-color: #e8f5e9; border-color: #66bb6a;">
                <h2 class="postit-title">Beneficios</h2>
                <p class="postit-text">
                    Obtén confianza y habilidades para comunicarte en inglés mientras te diviertes aprendiendo.
                </p>
            </div>
        </div>
    </div>

    <!-- Grid de Cards de Lecciones -->
    <div class="cardmobile-only cards-grid mt-5">
        @foreach($lecciones as $leccion)
            <div class="card-item">
                <div class="card fixed-card">
                    <img src="{{ asset('storage/' . $leccion->image) }}" alt="{{ $leccion->title }}" class="card-img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $leccion->title }}</h5>
                        <p style="color: black;" class="card-text">{{ Str::limit($leccion->description, 100) }}</p>
                        <div class="card-actions">
                            <a href="{{ route('curso.basico.show', $leccion->id) }}" class="btn btn-primary btn-sm" title="Ver más">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('curso.basico.destroy', $leccion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta lección?');">
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

<div class="custom-home-button text-center mt-4">
    <a href="{{ url('/') }}" class="custom-btn" title="Volver al Home">
        <i class="bi bi-house-fill fs-3"></i> Home
    </a>
</div>
@endsection
