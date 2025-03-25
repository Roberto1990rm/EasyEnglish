@extends('layouts.app')

@section('title', 'Subscribe')

@section('content')
    <div class="max-w-md mx-auto p-4">
        <form action="{{ route('subscribe.checkout') }}" method="POST">
            @csrf
            <label for="plan">Selecciona un plan:</label>
            <select name="plan" class="block w-full mt-2 mb-4 p-2 border rounded">
                <option value="1">1 mes - 3€</option>
                <option value="3">3 meses - 6€</option>
                <option value="6">6 meses - 10€</option>
                <option value="12">1 año - 14€</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Suscribirse
            </button>
        </form>
    </div>

    

@endsection
