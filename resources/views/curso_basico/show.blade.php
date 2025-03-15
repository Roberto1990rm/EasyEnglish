@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Botón para agregar entrada -->
    <div class="text-center mb-4">
        <a href="{{ route('pronouns.create', $leccion->id) }}" class="custom-add-btn">
            <i class="bi bi-plus-circle-fill"></i> Agregar entrada
        </a>
    </div>

    <!-- Información de la lección -->
    <div style="margin-bottom: -30px;" class="custom-lesson-info text-center">
        <h1 class="p1Home display-4">{{ $leccion->title }}</h1>
        <p class=" lead">{{ $leccion->description }}</p>
    </div>

    <!-- Carrusel de Pronombres -->
    @if($leccion->pronouns->count() > 0)
    <div class="position-relative">
        <div class="pronouns-slider-container overflow-hidden">
            <div class="d-flex pronouns-slider transition">
                @foreach($leccion->pronouns as $pronoun)
                <div class="pronoun-card p-3">
                    <div class="card shadow-sm border-0">
                        @if($pronoun->image)
                        <img src="{{ asset('storage/' . $pronoun->image) }}" class="card-img-top" alt="{{ $pronoun->pronoun }}">
                        @else
                        <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="Imagen no disponible">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-center text-primary">{{ $pronoun->pronoun }}</h5>
                            <p class="card-text text-center text-muted">{{ Str::limit($pronoun->description, 100) }}</p>
                            
                            @if($pronoun->audio)
                            <div class="text-center my-2">
                                <audio controls class="w-100">
                                    <source src="{{ asset('storage/' . $pronoun->audio) }}" type="audio/mpeg">
                                    Tu navegador no soporta el audio.
                                </audio>
                            </div>
                            @endif
                            
                            @if($pronoun->video)
                            <div class="text-center my-2">
                                <video controls class="w-100 rounded">
                                    <source src="{{ asset('storage/' . $pronoun->video) }}" type="video/mp4">
                                    Tu navegador no soporta el video.
                                </video>
                            </div>
                            @endif
                            
                            <ul class="list-group list-group-flush my-2">
                                <li class="list-group-item">
                                    <strong>Traducción:</strong> <span class="text-dark">{{ $pronoun->translation }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ejemplo 1:</strong> <span class="text-primary">{{ $pronoun->example_1 }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Ejemplo 2:</strong> <span class="text-success">{{ $pronoun->example_2 }}</span>
                                </li>
                            </ul>
                            
                            <div class="d-flex justify-content-center mt-3">
                                <form action="{{ route('pronouns.destroy', ['leccion_id' => $leccion->id, 'id' => $pronoun->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este pronoun?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Botones del carrusel -->
        <button id="prev-slide" class="slider-btn btn btn-outline-secondary position-absolute top-50 start-0 translate-middle-y">&#10094;</button>
        <button id="next-slide" class="slider-btn btn btn-outline-secondary position-absolute top-50 end-0 translate-middle-y">&#10095;</button>
    </div>
    @else
    <p class="text-center mt-4 text-danger">No hay pronombres disponibles para esta lección.</p>
    @endif



    <div class="custom-home-button text-center mt-2">
        <a  href="{{ route('curso.basico.index') }}" class="custom-btn" title="Volver al Home">
            <i class="bi bi-house-fill fs-3"></i> Curso Básico
        </a>
    </div>
   
    <!-- Botón para regresar -->
  




</div>

<!-- Estilos personalizados para el carrusel -->
<style>
.pronouns-slider-container {
    position: relative;
    width: 100%;
    overflow: hidden;
}
.pronouns-slider {
    display: flex;
    transition: transform 0.5s ease;
}
.pronoun-card {
    min-width: 300px;
}
</style>

<!-- Script para el carrusel -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".pronouns-slider");
    const prevBtn = document.querySelector("#prev-slide");
    const nextBtn = document.querySelector("#next-slide");
    const pronounCards = document.querySelectorAll(".pronoun-card");

    let index = 0;
    const cardWidth = pronounCards[0].offsetWidth + 20; // Ancho de cada tarjeta + espacio
    const totalSlides = pronounCards.length;

    nextBtn.addEventListener("click", () => {
        index = (index < totalSlides - 1) ? index + 1 : 0;
        slider.style.transform = `translateX(-${index * cardWidth}px)`;
    });

    prevBtn.addEventListener("click", () => {
        index = (index > 0) ? index - 1 : totalSlides - 1;
        slider.style.transform = `translateX(-${index * cardWidth}px)`;
    });
});
</script>
@endsection
