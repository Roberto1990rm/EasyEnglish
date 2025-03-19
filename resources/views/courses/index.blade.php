@extends('layouts.app')

@section('title', 'Cursos disponibles')

@section('content')
        @auth
<div class="text-center items-center mb-3">
    <a href="{{ route('courses.create') }}" class="btn bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">+ Crear curso</a>
</div>
@endauth

<div class="container mx-auto mb-2">
    @if($courses->isEmpty())
        <p class="text-gray-600">No hay cursos disponibles por ahora.</p>
    @else
    <h1 style="text-shadow: rgb(15, 15, 15) 4px 4px 7px" class="text-white text-center text-3xl font-bold text-gray-800 mb-3">Cursos Disponibles</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 pt-3">
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
            @auth
            <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este curso?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="mt-3 text-red-500 hover:text-red-700">Eliminar</button>
            </form>
        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
