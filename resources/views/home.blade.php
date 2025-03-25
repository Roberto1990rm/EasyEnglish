@extends('layouts.app')

@section('title', 'Sobre Nosotros | EasyEnglish')

@section('content')

<div style="margin-top: -65px;" class=" py-16">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Encabezado -->
        <div class="text-center">
            <h1 style="font-size: 60px;" class="honk-    mb-2  fst-italic">
                Conoce EasyEnglish
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-2">
                Somos más que una plataforma de enseñanza: somos una comunidad apasionada por el aprendizaje del inglés.
            </p>
        </div>

        <!-- Sección del Equipo / Historia -->
        <div class="grid md:grid-cols-2 gap-10 mb-10 items-center">
            <img src="{{ asset('images/about-team.jpg') }}" alt="Nuestro equipo" class="rounded-lg shadow-lg">
            <div class="px-6 pt-6 pb-6 text-center rounded-xl shadow-md hover:shadow-xl transition duration-300" style="background-color: blanchedalmond;">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">¿Quiénes somos?</h2>
                <p class="text-gray-700 leading-relaxed">
                    EasyEnglish nace del deseo de democratizar el aprendizaje del idioma inglés para todos, sin importar edad o ubicación. Nuestro equipo está formado por docentes certificados, diseñadores instruccionales y desarrolladores que creen en una educación accesible, interactiva y divertida.
                </p>
            </div>
        </div>

        <!-- Misión, Visión, Valores -->
        <div class="grid md:grid-cols-3 gap-8 mb-16 text-center">
            <div class="bg-blue-50 rounded-lg p-6 shadow-md">
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Nuestra Misión</h3>
                <p class="text-gray-600">
                    Brindar herramientas de aprendizaje efectivas y accesibles para dominar el inglés desde cualquier parte del mundo.
                </p>
            </div>
            <div class="bg-blue-50 rounded-lg p-6 shadow-md">
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Nuestra Visión</h3>
                <p class="text-gray-600">
                    Ser la plataforma educativa de referencia en enseñanza del inglés en Latinoamérica y el mundo.
                </p>
            </div>
            <div class="bg-blue-50 rounded-lg p-6 shadow-md">
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Nuestros Valores</h3>
                <ul class="text-gray-600 text-left list-disc list-inside">
                    <li>Accesibilidad</li>
                    <li>Innovación</li>
                    <li>Pasión por enseñar</li>
                    <li>Calidad humana</li>
                </ul>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-xl p-10 text-center shadow-lg">
            <h2 class="text-3xl font-bold mb-4">¿Listo para comenzar a aprender con nosotros?</h2>
            <p class="mb-6 text-lg">Únete a miles de estudiantes que ya están mejorando su inglés con EasyEnglish.</p>
            @guest
    <a href="{{ route('register') }}" class="inline-block bg-white text-blue-700 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
        Crear una cuenta
    </a>
@endguest

@auth
    <a href="{{ route('courses.index') }}" class="inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition">
        Ir a cursos
    </a>
@endauth

        </div>
    </div>
</div>
@endsection
