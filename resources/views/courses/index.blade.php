@extends('layouts.app')

@section('title', 'Cursos disponibles')

@section('content')

@auth
@if(auth()->user()->admin)
<div class="text-center items-center mb-3 mt-2">
    <a href="{{ route('courses.create') }}" class="btn bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Crear curso</a>
</div>
@endif
@endauth

<style>
    .boldonse-regular {
        font-family: "Boldonse", system-ui;
        font-weight: 400;
        font-style: normal;
    }
</style>

<div class="container mx-auto px-4 py-10">
    <div style="margin-top: -15px;" class="text-center mb-2">
        <h1 style="color: rgb(6, 247, 243); -webkit-text-stroke: 1px black; text-stroke: 1px black;"
            style="color: rgb(247, 231, 6); text-shadow:black 3px 3px 6px;"
            class="boldonse-regular text-5xl font-bold text-gray-800 ">Bienvenidos a EasyEnglish</h1>
        <p style="color: white; text-shadow:black 3px 3px 6px;" class="mt-4 text-lg text-gray-600">Explora nuestros cursos
            de inglés adaptados a todos los niveles.</p>
    </div>


<div  class="container mx-auto mb-2">
    @if($courses->isEmpty())
        <p class="text-gray-600">No hay cursos disponibles por ahora.</p>
    @else
    <div class="bg-orange-400 bg-opacity-90 rounded-lg shadow-md text-center py-6 px-4 mb-8">
    <h2 class="text-3xl font-extrabold text-white mb-2" style="text-shadow: 2px 2px 5px black;">
        Cursos disponibles
    </h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-8 pt-3">

            @foreach($courses as $course)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $course->image) }}" class="w-full h-40 object-cover" alt="{{ $course->title }}">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $course->title }}</h2>
                        <div class="descripcion-scroll text-gray-600 mt-2 prose max-w-none">
                            {!! $course->description !!}
                        </div>
                        <div class="text-sm text-gray-500 mt-3">
                            <i class="bi bi-person-fill"></i> {{ $course->author }}
                        </div>
                        <!-- Botón eliminar -->
                        <div class="text-center">
                            <a href="{{ route('courses.show', $course) }}" class="mt-3 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                <i class="bi bi-eye-fill"></i> Ver Curso
                            </a>
                        </div>

                        @auth
                        @if(auth()->user()->admin)
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este curso?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-3 text-red-500 hover:text-red-700">Eliminar</button>
                            </form>
                            <a style="color: blue;" href="{{ route('courses.edit', $course) }}">Editar curso</a>
                        @endif
                    @endauth
                    
                    </div>
                </div>
            @endforeach
        </div>
    @endif

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
</div>
@endsection
