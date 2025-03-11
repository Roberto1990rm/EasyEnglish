@extends('layouts.app')

@section('title', 'Bienvenido a EasyEnglish')

@section('content')
<div class="containerHome">
    <div class="container my-5">
        <h1 class="h1Home display-4 text-center">
            <span class="word1">Bienvenido</span> 
            <span class="word2">a</span> 
            <span class="easy">Easy</span><span class="english">English</span>
        </h1>
        <p class="p1Home lead text-center">
            <span class="">Tu</span> 
            <span class="">plataforma</span> 
            <span class="">para</span> 
            <span class="">aprender</span> 
            <span class="">inglés</span> 
            <span class="">de</span> 
            <span class="">forma</span> 
            <span class="">fácil</span> 
            <span class="">y</span> 
            <span class="">divertida.</span>
        </p>
        <div class="text-center">
            <a href="#cursos" class="btn btn-primary btn-lg">Explorar nuestros cursos</a>
        </div>
    </div>
</div>


    <div class="container my-5" id="cursos">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('images/basico1.jpg') }}" class="card-img-top" style="height: 275px;" alt="Curso de Inglés">

                    <div class="card-body">
                        <h5 class="card-title">Curso Básico de Inglés</h5>
                        <p class="card-text">Aprende los conceptos básicos del inglés con clases interactivas y dinámicas.</p>
                        <div class="text-center">
                        <a href="{{ route('curso.basico.index') }}" class="btn btn-primary">Ver más</a>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('images/basico2.jpg') }}" class="card-img-top" alt="Curso de Inglés" style="height: 275px;">

                    <div class="card-body">
                        <h5 class="card-title">Curso Intermedio de Inglés</h5>
                        <p class="card-text">Amplía tus conocimientos del inglés con lecciones y ejercicios de nivel intermedio.</p>
                        <div class="text-center">
                            <a href="#" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('images/basico3.jpg') }}" style="height: 275px;" class="card-img-top" alt="Curso de Inglés">

                    <div class="card-body">
                        <h5 class="card-title">Curso Avanzado de Inglés</h5>
                        <p class="card-text">Perfecciona tu inglés con clases avanzadas centradas en fluidez y comprensión.</p>
                        <div class="text-center">
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card"  style="margin-bottom: 0px;">
                            <div class="card-header">{{ __('Dashboard') }}</div>
            
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
            
                                {{ __('You are logged in!') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
