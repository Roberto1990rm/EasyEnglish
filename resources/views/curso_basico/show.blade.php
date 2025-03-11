@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">{{ $leccion['title'] }}</h1>
    <div class="text-center">
        <img src="{{ asset('images/' . $leccion['image']) }}" class="img-fluid" alt="{{ $leccion['title'] }}">
    </div>
    <p class="mt-3">{{ $leccion['description'] }}</p>
    <a href="{{ route('curso.basico.index') }}" class="btn btn-secondary">Volver al curso</a>
</div>
@endsection
