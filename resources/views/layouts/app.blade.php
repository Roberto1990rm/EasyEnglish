<!-- resources/views/layouts/main.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EasyEnglish')</title>

    <!-- Estilos y Fuentes -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&family=Bungee+Tint&family=Honk&family=Tektur:wght@400..900&display=swap" rel="stylesheet">
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .menu-icon {
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
        }
        .menu-icon:hover .tooltip {
            opacity: 1;
            visibility: visible;
        }
        .tooltip {
            position: absolute;
            top: 110%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease-in-out;
        }

        .boldonse-regular {
  font-family: "Boldonse", system-ui;
  font-weight: 400;
  font-style: normal;
}

.tektur {
  font-family: "Tektur", sans-serif;
  font-optical-sizing: auto;
  font-weight: <weight>;
  font-style: normal;
  font-variation-settings:
    "wdth" 100;
}

.honk- {
  font-family: "Honk", system-ui;
  font-optical-sizing: auto;
  font-weight: 400;
  font-style: normal;
  font-variation-settings:
    "MORF" 15,
    "SHLN" 50;
}


    </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

<nav class=" bg-white shadow-md fixed w-full z-50">
    <div style="font-size: 13.5px;" class="boldonse-regular max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo1.png') }}" alt="EasyEnglish Logo" class="h-10">
            </a>
            <!-- Menú Escritorio con textos -->
            <div style="text-shadow: black 2px 2px 4px;" class="hidden md:flex space-x-6">
                <a href="{{ url('/') }}" class="px-4 py-2 rounded-lg text-white font-semibold bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 transition">
                    Inicio
                </a>
                <a href="{{ route('courses.index') }}" class="px-4 py-2 rounded-lg text-white font-semibold bg-gradient-to-r from-green-500 to-lime-500 hover:from-green-600 hover:to-lime-600 transition">
                    Cursos
                </a>
                <a href="{{ route('contact.show') }}" class="px-4 py-2 rounded-lg text-white font-semibold bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-600 hover:to-red-600 transition">
                    Contacto
                </a>
            </div>

            <!-- Menú Móvil con Iconos y Etiquetas -->
            <div class="flex md:hidden justify-around items-center space-x-8">
                <a style="background-color: rgb(250, 162, 0);" href="{{ url('/') }}" class="menu-icon text-gray-700 hover:bg-gray-50">
                    <i  class="bi bi-house-door-fill"></i>
                    <span class="tooltip">Inicio</span>
                </a>
                <a style="background-color: rgb(0, 250, 29);"  href="{{ route('courses.index') }}" class="menu-icon text-gray-700 hover:bg-gray-50">
                    <i class="bi bi-book-fill"></i>
                    <span class="tooltip">Cursos</span>
                </a>
    

                <a style="background-color: rgb(246, 0, 250);"  href="{{ route('contact.show') }}" class="menu-icon text-gray-700 hover:bg-gray-50">
                    <i class="bi bi-envelope-fill"></i>
                    <span class="tooltip">Contacto</span>
                </a>
            </div>

            <div class="relative flex items-center">
                @auth
                    <button id="userDropdownBtn" class="flex items-center space-x-2 text-gray-700 hover:text-blue-500">
                        <i class="bi bi-person-circle text-xl"></i>
                        <span class="hidden md:inline">{{ auth()->user()->name }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>

                    <div style="text-shadow: rgb(106, 104, 104) 1px 1px 2px;" id="userDropdown" class="tektur absolute right-0 top-full mt-2 w-48 bg-white rounded-md shadow-lg hidden z-50">
                        @if(auth()->user()->admin)
                            <div class="px-4 py-2 text-sm text-gray-500">Admin</div>
                            <a href="{{ route('courses.create') }}" class="block px-4 py-2 hover:bg-gray-100">Crear curso</a>
                            <a href="{{ route('lessons.create') }}" class="block px-4 py-2 hover:bg-gray-100">
                               Crear Lección
                            </a>
                            <a href="{{ route('courses.index') }}" class="block px-4 py-2 hover:bg-gray-100">Gestionar cursos</a>
                            <div class="border-t my-1"></div>
                        @endif

                        <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Mi Perfil</a>

                        
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500">Login</a>
                    <a href="{{ route('register') }}" class="ml-4 text-gray-700 hover:text-blue-500">Registro</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main class="tektur flex-grow pt-20">
    @yield('content')
</main>

<footer class="bg-gray-800 text-white text-center mt-auto">
    <p>&copy; {{ date('Y') }} EasyEnglish. Todos los derechos reservados.</p>
</footer>

<script>
    document.getElementById('userDropdownBtn').addEventListener('click', function(event) {
        event.stopPropagation();
        document.getElementById('userDropdown').classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const btn = document.getElementById('userDropdownBtn');

        if (!dropdown.contains(event.target) && !btn.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>

</body>
</html>