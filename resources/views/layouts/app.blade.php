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

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Tooltip personalizado */
        .tooltip {
            position: absolute;
            background-color: rgba(0, 0, 0, 0.99);
            color: white;
            padding: 5px 8px;
            border-radius: 5px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            pointer-events: none;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Navbar -->
    <nav style="height: 40px;" class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="pb-3 flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="text-xl font-bold text-gray-800">EasyEnglish</a>

                <!-- Links de navegación -->
                <div class="flex space-x-6 relative">
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 text-lg flex flex-col items-center md:flex-row md:space-x-2 tooltip-container">
                        <i class="fas fa-home md:hidden"></i> 
                        <span class="hidden md:inline">Home</span>
                        <span class="tooltip">Home</span>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 text-lg flex flex-col items-center md:flex-row md:space-x-2 tooltip-container">
                        <i class="fas fa-info-circle md:hidden"></i> 
                        <span class="hidden md:inline">About</span>
                        <span class="tooltip">About</span>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 text-lg flex flex-col items-center md:flex-row md:space-x-2 tooltip-container">
                        <i class="fas fa-envelope md:hidden"></i> 
                        <span class="hidden md:inline">Contact</span>
                        <span class="tooltip">Contact</span>
                    </a>
                </div>

                <!-- Menú de usuario -->
                <div class="items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">Register</a>
                    @else
                        <div class="relative">
                            <button id="userDropdownButton" onclick="toggleUserDropdown()" class="text-gray-600 hover:text-blue-600 flex items-center">
                                <i class="bi bi-person-circle text-lg"></i>
                                <span class="ml-2">{{ Auth::user()->name }}</span>
                            </button>

                            <div id="userDropdownMenu" class="absolute right-0 mt-1 w-48 bg-white shadow-md p-4 rounded-lg hidden">
                                <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Perfil</a>
                                <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Configuración</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido de la página -->
    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center  mt-auto">
        <p>&copy; {{ date('Y') }} EasyEnglish. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts -->
    <script>
        function toggleUserDropdown() {
            let menu = document.getElementById("userDropdownMenu");
            menu.classList.toggle("hidden");
        }

        // Cerrar menús al hacer clic fuera
        document.addEventListener("click", function(event) {
            let userDropdownMenu = document.getElementById("userDropdownMenu");
            let userDropdownButton = document.getElementById("userDropdownButton");

            if (userDropdownMenu && !userDropdownButton.contains(event.target) && !userDropdownMenu.contains(event.target)) {
                userDropdownMenu.classList.add("hidden");
            }
        });

        // Mostrar tooltip al pasar el mouse sobre los iconos
        document.querySelectorAll(".tooltip-container").forEach(el => {
            el.addEventListener("mouseenter", () => el.querySelector(".tooltip").style.opacity = "1");
            el.addEventListener("mouseleave", () => el.querySelector(".tooltip").style.opacity = "0");
        });
    </script>
</body>
</html>
