@extends('layouts.app')

@section('title', 'Usuarios registrados')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-center text-blue-800 mb-8">Gestión de Usuarios</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Nombre</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Rol</th>
                    <th class="px-6 py-3 text-left">Suscripción</th>
                    <th class="px-6 py-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @if($user->admin)
                            <span class="text-green-600 font-semibold">Admin</span>
                        @else
                            Usuario
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($user->subscriber)
                            <span class="text-green-600 font-semibold">Suscrito ✅</span>
                        @else
                            <span class="text-red-500 font-semibold">No ❌</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 space-y-1 md:space-x-2">
                        <!-- Botón cambiar suscripción -->
                        <form action="{{ route('admin.users.toggleSubscription', $user) }}" method="POST" class="inline-block">
                            @csrf
                            <button class="text-sm bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                Cambiar suscripción
                            </button>
                        </form>

                        @if($user->email !== 'admin@easyenglish.com')
                            <!-- Botón cambiar rol admin -->
                            <form action="{{ route('admin.users.toggleAdmin', $user) }}" method="POST" class="inline-block">
                                @csrf
                                <button class="text-sm {{ $user->admin ? 'bg-purple-600' : 'bg-green-600' }} text-white px-3 py-1 rounded hover:opacity-90">
                                    {{ $user->admin ? 'Quitar Admin' : 'Hacer Admin' }}
                                </button>
                            </form>

                            <!-- Botón eliminar -->
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Eliminar
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500 text-sm">Admin protegido</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botón volver a perfil -->
    <div class="text-center mt-12">
        <a href="{{ route('profile') }}"
           class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
            <i class="bi bi-person-circle mr-2 text-xl"></i>
            Volver a Perfil
        </a>
    </div>
</div>
@endsection
