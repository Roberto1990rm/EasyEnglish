@extends('layouts.app')

@section('title', 'Contacto | EasyEnglish')

@section('content')
<div style="margin-top: -20px;" class="container bg-white mx-auto px-4 py-16 max-w-5xl">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Información de contacto / branding -->
        <div class="text-center space-y-6">
            <h1 class="text-4xl font-bold text-blue-800 mb-2">Contáctanos</h1>
            <p class="text-gray-600 text-lg">
                ¿Tienes dudas, sugerencias o simplemente quieres saludar? ¡Estamos aquí para ayudarte! Completa el formulario y te responderemos lo antes posible.
            </p>

            <div class="space-y-3 text-gray-700">
                <div class="flex items-center gap-3">
                    <i class="bi bi-geo-alt-fill text-blue-600 text-xl"></i>
                    <span>Buenos Aires, Argentina</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="bi bi-envelope-fill text-blue-600 text-xl"></i>
                    <span>easyenglish.contacto@gmail.com</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="bi bi-telephone-fill text-blue-600 text-xl"></i>
                    <span>+54 9 11 1234 5678</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="bi bi-instagram text-pink-500 text-xl"></i>
                    <a href="#" class="hover:underline" target="_blank">@easyenglish</a>
                </div>
            </div>

            <img src="{{ asset('images/about-team.jpg') }}" alt="Contáctanos" class="w-3/4 mt-6 hidden md:block">
        </div>

        <!-- Formulario -->
        <div>
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-4">
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
                    <textarea name="message" id="message" rows="6" class="w-full border-gray-300 rounded mt-1" placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Enviar Mensaje
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
