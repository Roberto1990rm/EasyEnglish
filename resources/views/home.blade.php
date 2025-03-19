<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <div class="item  shadow-md p-6 rounded-lg">
            <h1 class="text-xl font-bold text-gray-800">Bienvenido a MyWebsite</h1>
            <p class="text-gray-600 mt-4">Tu sitio moderno con Laravel y Blade</p>
        </div>
        
        <div class="item  shadow-md p-6 rounded-lg">
            <h1 class="text-xl font-bold text-gray-800">Bienvenido a MyWebsite</h1>
            <p class="text-gray-600 mt-4">Tu sitio moderno con Laravel y Blade</p>
        </div>

        <div class="item  shadow-md p-6 rounded-lg">
            <h1 class="text-xl font-bold text-gray-800">Bienvenido a MyWebsite</h1>
            <p class="text-gray-600 mt-4">Tu sitio moderno con Laravel y Blade</p>
        </div>


        <div class="item  shadow-md p-6 rounded-lg">

            <h1 class="text-xl font-bold text-gray-800">Bienvenido a MyWebsite x</h1>
            <p class="text-gray-600 mt-4">Tu sitio moderno con Laravel y Blade</p>
        </div>
    </div>
</div>

@endsection
