@extends('layouts.app')

@section('content')

<div class="text-center">
<a href="{{ route('pronouns.create', $leccion->id) }}" class="btn btn-primary mt-3">Agregar Pronombre</a>
</div>
<div class="container">
    <h1 class="text-center">{{ $leccion->title }}</h1>

    <!-- Imagen de la lección -->
    

    <p class="descripcion1">{{ $leccion->description }}</p>

    <!-- Sección de Pronombres -->
    <h2 class="text-center">Pronouns</h2>
    <div class="row">
        @foreach($leccion->pronouns as $pronoun)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <!-- Imagen del pronombre -->
                    @if($pronoun->image)
                        <img src="{{ asset('storage/' . $pronoun->image) }}" class="card-img-top" alt="{{ $pronoun->pronoun }}">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="Imagen no disponible">
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $pronoun->pronoun }}</h5>
                        <p class="card-text">{{ Str::limit($pronoun->description, 100) }}</p>

                        <!-- Audio -->
                        @if($pronoun->audio)
                            <audio controls class="w-100 mt-2">
                                <source src="{{ asset('storage/' . $pronoun->audio) }}" type="audio/mpeg">
                                Tu navegador no soporta el audio.
                            </audio>
                        @endif

                        <!-- Video -->
                        @if($pronoun->video)
                            <div class="mt-2">
                                <video controls class="w-100">
                                    <source src="{{ asset('storage/' . $pronoun->video) }}" type="video/mp4">
                                    Tu navegador no soporta el video.
                                </video>
                            </div>
                        @endif

                        <p class="text-muted"><strong>Traducción:</strong> {{ $pronoun->translation }}</p>
                        <p><strong>Ejemplo 1:</strong> {{ $pronoun->example_1 }}</p>
                        <p><strong>Ejemplo 2:</strong> {{ $pronoun->example_2 }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('curso.basico.index') }}" class="btn btn-secondary mt-4">Volver al curso</a>
</div>
@endsection
