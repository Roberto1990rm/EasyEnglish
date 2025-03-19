@extends('layouts.app')

@section('title', 'Cursos disponibles')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Cursos Disponibles</h1>

    @if($courses->isEmpty())
        <p class="text-gray-600">No hay cursos disponibles por ahora.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($courses as $course)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $course->image) }}" class="w-full h-40 object-cover" alt="{{ $course->title }}">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $course->title }}</h2>
                        <p class="text-gray-600 mt-2">{{ $course->description }}</p>
                        <div class="text-sm text-gray-500 mt-3">
                            <i class="bi bi-person-fill"></i> {{ $course->author }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
