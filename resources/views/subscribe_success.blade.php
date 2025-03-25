@extends('layouts.app')

@section('title', 'Subscribe')

@section('content')

    <div class="max-w-xl mx-auto mt-12 p-6 bg-white shadow rounded text-center">
        <h1 class="text-2xl font-bold text-green-600 mb-4">¡Suscripción exitosa!</h1>
        <p class="text-lg">Gracias por tu compra. Tu suscripción será válida durante <strong>{{ $months }} mes{{ $months > 1 ? 'es' : '' }}</strong>.</p>

        <a href="{{ route('profile') }}" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Ir al panel
        </a>
    </div>



@endsection



