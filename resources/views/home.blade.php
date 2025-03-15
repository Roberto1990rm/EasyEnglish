@extends('layouts.app')

@section('title', 'Bienvenido a EasyEnglish')

@section('content')
<div class="containerHome">
    <div class="container mt-5">
        <h1 class="h1Home display-4 text-center">
            <span class="word1">Bienvenido</span> 
            <span class="word2">a</span> 
            <span class="easy">Easy</span><span class="english">English</span>
        </h1>
        <p class="p1Home lead text-center mt-5">
            <span>Tu</span> 
            <span>plataforma</span> 
            <span>para</span> 
            <span>aprender</span> 
            <span>inglés</span> 
            <span>de</span> 
            <span>forma</span> 
            <span>fácil</span> 
            <span>y</span> 
            <span>divertida.</span>
        </p>
        <div class="btnHome text-center mt-5 ">
            <a href="#cursos" class="custom-add-btn">Explorar nuestros cursos</a>
        </div>
    </div>
</div>

     <<div class="container" id="cursos">
        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card cardHome shadow-sm h-100">
                    <img src="{{ asset('images/basico1.jpg') }}" class="card-img-top" style="height:200px; object-fit:cover;" alt="Curso de Inglés">
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title mt-1">Curso Básico de Inglés</h5>
                        <p class="card-text">Aprende los conceptos básicos del inglés con clases interactivas y dinámicas.</p>
                        <div class="mt-auto">
                            <a href="{{ route('curso.basico.index') }}" class="btn btn-primary btn-sm mb-2" title="Ver más">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card cardHome shadow-sm h-100">
                    <img src="{{ asset('images/basico2.jpg') }}" class="card-img-top" style="height:200px; object-fit:cover;" alt="Curso de Inglés">
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title mt-1">Curso Intermedio de Inglés</h5>
                        <p class="card-text">Amplía tus conocimientos del inglés con lecciones y ejercicios de nivel intermedio.</p>
                        <div class="mt-auto">
                            <a href="#" class="btn btn-primary btn-sm mb-2" title="Ver más">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card cardHome shadow-sm h-100">
                    <img src="{{ asset('images/basico3.jpg') }}" class="card-img-top" style="height:200px; object-fit:cover;" alt="Curso de Inglés">
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title mt-1">Curso Avanzado de Inglés</h5>
                        <p class="card-text">Perfecciona tu inglés con clases avanzadas centradas en fluidez y comprensión.</p>
                        <div class="mt-auto">
                            <a href="#" class="btn btn-primary btn-sm mb-2" title="Ver más">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    </div>
</div>
@endsection
