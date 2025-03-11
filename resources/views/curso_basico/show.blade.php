@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">{{ $leccion->title }}</h1>
    <img src="{{ asset('storage/' . $leccion->image) }}" class="card-img-top" alt="{{ $leccion->title }}">
    <p  class="descripcion1 mt-3">{{ $leccion->description }}</p>
    <a href="{{ route('curso.basico.index') }}" class="btn btn-secondary">Volver al curso</a>
</div>
@endsection
