<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Bienvenidos a EasyEnglish')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div style="margin-top: -15px;"  class="text-center mb-10">
        <h1 style="color: rgb(247, 231, 6); text-shadow:black 3px 3px 6px;" class="text-5xl font-bold text-gray-800">Bienvenidos a EasyEnglish</h1>
        <p style="color: white; text-shadow:black 3px 3px 6px;" class="mt-4 text-lg text-gray-600">Explora nuestros cursos de inglés adaptados a todos los niveles.</p>
    </div>

    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($courses as $course)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $course->title }}</h2>
                    <div class="descripcion-scroll mt-2 text-gray-600 prose max-w-none">
                        {!! $course->description !!}
                    </div>
                    <p class="text-sm text-gray-500 mt-3"><i class="bi bi-person"></i> Autor: {{ $course->author }}</p>
                </div>
            </div>
        @endforeach
    </section>

    <section style="opacity: 0.9; margin-bottom: -10px;" class="my-16 bg-blue-100 rounded-lg p-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800">¿Por qué elegir EasyEnglish?</h2>
        <ul class="mt-6 text-gray-700 grid grid-cols-1 md:grid-cols-3 gap-4">
            <li class="flex flex-col items-center">
                <i class="bi bi-journal-check text-4xl text-blue-600"></i>
                <span class="mt-2 font-semibold">Cursos personalizados</span>
            </li>
            <li class="flex flex-col items-center">
                <i class="bi bi-people-fill text-4xl text-blue-600"></i>
                <span class="mt-2 font-semibold">Profesores calificados</span>
            </li>
            <li class="flex flex-col items-center">
                <i class="bi bi-clock-fill text-4xl text-blue-600"></i>
                <span class="mt-2 font-semibold">Flexibilidad horaria</span>
            </li>
        </ul>
    </section>
    @auth
    <section style="margin-bottom: -10px;" class="text-center my-12">
        <a href="{{ route('courses.create') }}" class="bg-blue-600 text-white py-3 px-8 rounded-lg hover:bg-blue-700 transition duration-300">
            Crear nuevo curso
        </a>
    </section>
    @endauth
</div>
@endsection