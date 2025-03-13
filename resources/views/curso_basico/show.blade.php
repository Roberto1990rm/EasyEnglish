@extends('layouts.app')

@section('content')

<div style="margin-bottom: -35px;" class="text-center">
    <a href="{{ route('pronouns.create', $leccion->id) }}" class="custom-add-btn">
        <i class="bi bi-plus-circle-fill"></i> Agregar entrada
    </a>
</div>

<<div class="custom-lesson-info container">
    <h1 class="custom-lesson-title text-center">{{ $leccion->title }}</h1>
    <p class="custom-lesson-description text-center">{{ $leccion->description }}</p>
</div>


<!-- Carrusel Deslizante de Pronombres -->
@if($leccion->pronouns->count() > 0)
<div class="pronouns-slider-container">
    <button id="prev-slide" class="slider-btn left">&#10094;</button>
    <div class="card-item pronouns-slider">
        @foreach($leccion->pronouns as $pronoun)
        <div class="pronoun-card p-2">
            <div class="innovative-card shadow">
                <!-- Contenedor de la imagen con clip-path -->
                <div class="innovative-card-img-container">
                    @if($pronoun->image)
                        <img src="{{ asset('storage/' . $pronoun->image) }}" class="innovative-card-img" alt="{{ $pronoun->pronoun }}">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="innovative-card-img" alt="Imagen no disponible">
                    @endif
                </div>
                <!-- Contenido de la card -->
                <div class="innovative-card-content p-3">
                    <h5 class="innovative-card-title fw-bold text-center">{{ $pronoun->pronoun }}</h5>
                    <p class="innovative-card-description text-center text-muted">
                        {{ Str::limit($pronoun->description, 100) }}
                    </p>
                    @if($pronoun->audio)
                        <div class="innovative-card-audio text-center my-2">
                            <audio controls class="w-100">
                                <source src="{{ asset('storage/' . $pronoun->audio) }}" type="audio/mpeg">
                                Tu navegador no soporta el audio.
                            </audio>
                        </div>
                    @endif
                    @if($pronoun->video)
                        <div class="innovative-card-video text-center my-2">
                            <video controls class="w-100 rounded shadow-sm">
                                <source src="{{ asset('storage/' . $pronoun->video) }}" type="video/mp4">
                                Tu navegador no soporta el video.
                            </video>
                        </div>
                    @endif
                    <div class="innovative-card-info mt-3">
                        <p class="text-center text-dark"><strong>Traducción:</strong> {{ $pronoun->translation }}</p>
                        <p class="text-center"><strong>Ejemplo 1:</strong> <span class="text-primary">{{ $pronoun->example_1 }}</span></p>
                        <p class="text-center"><strong>Ejemplo 2:</strong> <span class="text-success">{{ $pronoun->example_2 }}</span></p>
                    </div>
                </div>
                <form action="{{ route('pronouns.destroy', ['leccion_id' => $leccion->id, 'id' => $pronoun->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este pronoun?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                
            </div>
        </div>
        @endforeach
    </div>
    <button id="next-slide" class="slider-btn right">&#10095;</button>
</div>
@else
    <p class="text-center mt-4 text-danger">No hay pronombres disponibles para esta lección.</p>
@endif

<div style="margin-bottom: -0px;" class="custom-home-button text-center mt-4">
    <a href="{{ route('curso.basico.index') }}" class="custom-btn">
        <i class="bi bi-arrow-left-circle-fill"></i> Regresar al Curso Básico
    </a>
</div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".pronouns-slider");
    const prevBtn = document.querySelector("#prev-slide");
    const nextBtn = document.querySelector("#next-slide");
    const pronounCards = document.querySelectorAll(".pronoun-card");

    let index = 0;
    const cardWidth = pronounCards[0].offsetWidth + 20; // Tamaño de cada tarjeta + gap
    const totalSlides = pronounCards.length;

    nextBtn.addEventListener("click", () => {
        if (index < totalSlides - 1) {
            index++;
        } else {
            index = 0; // Vuelve al inicio si está en el último slide
        }
        slider.style.transform = `translateX(-${index * cardWidth}px)`;
    });

    prevBtn.addEventListener("click", () => {
        if (index > 0) {
            index--;
        } else {
            index = totalSlides - 1; // Va al último slide si está en el inicio
        }
        slider.style.transform = `translateX(-${index * cardWidth}px)`;
    });
});
</script>
@endsection
