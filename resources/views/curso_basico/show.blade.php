@extends('layouts.app')

@section('content')

<div class="text-center">
    <a href="{{ route('pronouns.create', $leccion->id) }}" class="btn btn-primary mt-3">Agregar entrada</a>
</div>

<div class="container" >
    <h1 class="p1Home mt-4 text-center">{{ $leccion->title }}</h1>
    <p class="text-center">{{ $leccion->description }}</p>

    <!-- Carrusel Deslizante de Pronombres -->
    @if($leccion->pronouns->count() > 0)
    <div class="pronouns-slider-container">
        <button id="prev-slide" class="slider-btn left">&#10094;</button>
        <div class="pronouns-slider">
            @foreach($leccion->pronouns as $pronoun)
            <div class="pronoun-card" >
                <div style="height: 450px;" class="card shadow-lg">
                    <!-- Imagen -->
                    @if($pronoun->image)
                        <img src="{{ asset('storage/' . $pronoun->image) }}" class="card-img-top rounded" alt="{{ $pronoun->pronoun }}" style="height: 250px;">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="card-img-top rounded" alt="Imagen no disponible">
                    @endif
                    
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ $pronoun->pronoun }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($pronoun->description, 100) }}</p>

                        <!-- Audio -->
                        @if($pronoun->audio)
                            <audio controls class="w-100 mt-2">
                                <source src="{{ asset('storage/' . $pronoun->audio) }}" type="audio/mpeg">
                                Tu navegador no soporta el audio.
                            </audio>
                        @endif

                        <!-- Video -->
                        @if($pronoun->video)
                            <div class="video-container mt-2">
                                <video controls class="w-100 rounded-3 shadow-sm">
                                    <source src="{{ asset('storage/' . $pronoun->video) }}" type="video/mp4">
                                    Tu navegador no soporta el video.
                                </video>
                            </div>
                        @endif

                        <p class="text-dark mt-2"><strong>Traducción:</strong> {{ $pronoun->translation }}</p>
                        <p><strong>Ejemplo 1:</strong> <span class="text-primary">{{ $pronoun->example_1 }}</span></p>
                        <p><strong>Ejemplo 2:</strong> <span class="text-success">{{ $pronoun->example_2 }}</span></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button id="next-slide" class="slider-btn right">&#10095;</button>
    </div>
    @else
        <p class="text-center mt-4 text-danger">No hay pronombres disponibles para esta lección.</p>
    @endif

    <div class="text-center mb-3">
        <a href="{{ route('curso.basico.index') }}" class="btn btn-secondary mt-4">Volver a curso básico</a>
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
