@extends('layouts.app')

@section('title', 'Bienvenido a EasyEnglish')

@section('content')
<div class="containerHome">
    <div class="container my-5">
        <h1 class="display-4 text-center">Bienvenido a EasyEnglish</h1>
        <p class="lead text-center">Tu plataforma para aprender inglés de forma fácil y divertida.</p>
        <div class="text-center">
            <a href="#cursos" class="btn btn-primary btn-lg">Explorar nuestros cursos</a>
        </div>
    </div>

    <div class="container my-5" id="cursos">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="https://via.placeholder.com/500x300?text=Curso+de+Ingl%C3%A9s" class="card-img-top" alt="Curso de Inglés">
                    <div class="card-body">
                        <h5 class="card-title">Curso Básico de Inglés</h5>
                        <p class="card-text">Aprende los conceptos básicos del inglés con clases interactivas y dinámicas.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="https://via.placeholder.com/500x300?text=Curso+de+Ingl%C3%A9s+Intermedio" class="card-img-top" alt="Curso Intermedio de Inglés">
                    <div class="card-body">
                        <h5 class="card-title">Curso Intermedio de Inglés</h5>
                        <p class="card-text">Amplía tus conocimientos del inglés con lecciones y ejercicios de nivel intermedio.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="https://via.placeholder.com/500x300?text=Curso+de+Ingl%C3%A9s+Avanzado" class="card-img-top" alt="Curso Avanzado de Inglés">
                    <div class="card-body">
                        <h5 class="card-title">Curso Avanzado de Inglés</h5>
                        <p class="card-text">Perfecciona tu inglés con clases avanzadas centradas en fluidez y comprensión.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
