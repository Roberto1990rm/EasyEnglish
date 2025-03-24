@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
    <div class="container mx-auto px-4 py-12 max-w-4xl">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">Perfil de Usuario</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-gray-600"><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
                    <p class="text-gray-600 mt-2"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                </div>
                <div>
                    <p class="text-gray-600"><strong>Rol:</strong>
                        @if (auth()->user()->admin)
                            <span class="text-green-600 font-semibold">Administrador</span>
                        @else
                            <span class="text-blue-600 font-semibold">Usuario normal</span>
                        @endif
                    </p>


                    @if (auth()->user()->admin)
                        <div class="mb-6 text-left mt-2">
                            <a href="{{ route('admin.users.index') }}"
                                class="inline-flex items-center bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                                <i class="bi bi-people-fill mr-2"></i> Ver Usuarios
                            </a>
                        </div>
                    @endif







                    <p class="text-gray-600 mt-2"><strong>Suscripción:</strong>
                        @if (auth()->user()->subscriber)
                            <span class="text-green-600 font-semibold">Suscrito ✅</span>
                        @else
                            <span class="text-red-500 font-semibold">No suscrito ❌</span>
                        @endif
                    </p>
                </div>
                <!-- Imagen de perfil -->
                <div class="text-center mb-6">
                    @if (auth()->user()->image)
                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Foto de perfil"
                            class="mx-auto w-42 h-42 object-cover rounded-full shadow-md mb-2">
                        <form action="{{ route('profile.deleteImage') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-sm">Eliminar imagen</button>
                        </form>
                    @else
                        <p class="text-gray-500">No has subido una imagen de perfil.</p>
                    @endif
                </div>

                <!-- Formulario para subir imagen y cambiar contraseña -->
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                    class="bg-gray-50 p-4 rounded shadow-md space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold">Subir nueva imagen</label>
                        <input type="file" name="image" class="mt-1 text-sm" accept="image/*">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold">Nueva contraseña</label>
                        <input type="password" name="password" class="w-full border-gray-300 rounded mt-1"
                            placeholder="••••••">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded mt-1"
                            placeholder="••••••">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Guardar cambios
                    </button>
                </form>

                @if (session('success'))
                    <div class="mt-4 text-green-600 font-semibold">{{ session('success') }}</div>
                @endif

            </div>

            <!-- Cursos creados -->
            <div class="mb-10">
                <h2 class="text-xl font-bold text-gray-800 mb-3">Cursos creados</h2>
                @php
                    $userCourses = \App\Models\Course::where('author', auth()->user()->name)->get();
                @endphp

                @if ($userCourses->isEmpty())
                    <p class="text-gray-500">No has creado ningún curso.</p>
                @else
                    <ul class="list-disc pl-6 text-blue-600">
                        @foreach ($userCourses as $course)
                            <li>
                                <a href="{{ route('courses.show', $course->id) }}" class="hover:underline">
                                    {{ $course->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Lecciones creadas -->
            <!-- Lecciones creadas -->
            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-3">Lecciones creadas</h2>
                @php
                    $userLessons = \App\Models\Lesson::where('user_id', auth()->id())
                        ->with('course')
                        ->get();
                @endphp

                @if ($userLessons->isEmpty())
                    <p class="text-gray-500">No has creado ninguna lección.</p>
                @else
                    <ul class="list-disc pl-6 text-gray-700">
                        @foreach ($userLessons as $lesson)
                            <li>
                                <a href="{{ route('courses.show', $lesson->course_id) }}#lesson-{{ $lesson->id }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $lesson->title }}
                                </a>
                                <span class="text-sm text-gray-500">(Curso:
                                    {{ $lesson->course->title ?? 'Sin título' }})</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>


        </div>
    </div>
@endsection
