@extends('layouts.app')

@section('title', 'Contacto | EasyEnglish')

@section('content')
    <div class="container mx-auto px-4 py-16 max-w-2xl">
        <h1 class="text-3xl font-bold text-center text-blue-800 mb-8">Contáctanos</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold">Nombre</label>
                <input type="text" name="name" id="name"
                    class="w-full border-gray-300 rounded mt-1 bg-gray-100 cursor-not-allowed"
                    value="{{ auth()->check() ? auth()->user()->name : old('name') }}" @auth readonly @endauth required>
            </div>
            <div>
                <label for="email" class="block text-sm font-semibold">Correo Electrónico</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="w-full border-gray-300 rounded mt-1 bg-gray-100 cursor-not-allowed" 
                    value="{{ auth()->check() ? auth()->user()->email : old('email') }}" 
                    @auth readonly @endauth
                    required
                >
            </div>
            <div>
                <label for="message" class="block text-sm font-semibold">Mensaje</label>
                <textarea name="message" id="message" rows="5" class="w-full border-gray-300 rounded mt-1" required></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Enviar Mensaje
            </button>
        </form>
    </div>
@endsection
