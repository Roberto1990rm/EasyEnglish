@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container mx-auto px-4 mb-3">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($courses as $course)
            <div class="bg-white shadow-md p-6 rounded-lg">
                <img 
                    src="{{ asset('storage/' . $course->image) }}" 
                    alt="{{ $course->title }}" 
                    class="w-full h-40 object-cover rounded-md"
                >
                <h1 class="text-xl font-bold text-gray-800 mt-4">{{ $course->title }}</h1>
                <p class="text-gray-600 mt-2">{{ $course->description }}</p>
                <p class="text-sm text-gray-500 mt-2">Autor: {{ $course->author }}</p>
            </div>
        @endforeach
    </div>
</div>

@endsection
