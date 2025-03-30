@extends('layouts.app')

@section('title', 'Suscribirse')

@section('content')
    <div class="max-w-md mx-auto p-6 space-y-6">

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded shadow">
                {{ $errors->first() }}
            </div>
        @endif

        @if ($alreadySubscribed)
            <div class="bg-blue-100 text-blue-800 p-4 rounded shadow">
                🟢 Ya estás suscrito hasta el <strong>{{ $subscriptionEnd->format('d M Y') }}</strong>.<br>
                Puedes ampliar tu suscripción. El nuevo tiempo se sumará a tu suscripción actual, hasta un máximo de 1 año desde hoy.
            </div>
        @endif

        <form action="{{ route('subscribe.checkout') }}" method="POST" class="bg-white p-4 rounded shadow space-y-4">
            @csrf

            <label for="plan" class="block text-sm font-bold">Selecciona un plan:</label>
            <select name="plan" class="w-full border px-3 py-2 rounded" required>
                <option value="1">1 mes - 3€</option>
                <option value="3">3 meses - 6€</option>
                <option value="6">6 meses - 10€</option>
                <option value="12">1 año - 14€</option>
            </select>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Ir a pagar con Stripe
            </button>
        </form>
    </div>
@endsection
