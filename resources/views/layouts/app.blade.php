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

<nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="/" class="text-xl font-bold text-gray-800">EasyEnglish</a>

            <div class="flex space-x-4">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 flex items-center">
                    <i class="fas fa-home md:hidden"></i>
                    <span class="hidden md:inline">Home</span>
                </a>
            
                <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
                    <i class="fas fa-info-circle md:hidden"></i>
                    <span class="hidden md:inline">About</span>
                </a>
            
                <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
                    <i class="fas fa-envelope md:hidden"></i>
                    <span class="hidden md:inline">Contact</span>
                </a>
            </div>

            <div class="relative">
                <button onclick="toggleUserDropdown()" class="text-gray-600 hover:text-blue-600 flex items-center">
                    <i class="bi bi-chevron-down ml-1"></i>
                    <i class="bi bi-person-circle text-xl"></i>
                    
                </button>

                <div id="userDropdownMenu" class="absolute right-0 mt-2 w-48 bg-white shadow-md rounded-lg hidden">
                    <a href="{{ route('courses.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Cursos</a>

                    <hr class="my-1">

                    @guest
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Register</a>
                    @else
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
</nav>

<main class="flex-grow pt-20">
    @yield('content')
</main>

<footer class="bg-gray-800 text-white text-center  mt-auto">
    <p>&copy; {{ date('Y') }} EasyEnglish. Todos los derechos reservados.</p>
</footer>

<script>
    const userDropdownButton = document.getElementById("userDropdownMenu");

    document.addEventListener("click", function(event) {
        const userDropdownMenu = document.getElementById("userDropdownMenu");
        const button = document.querySelector("nav button");

        if (!button.contains(event.target) && !userDropdownMenu.contains(event.target)) {
            userDropdownMenu.classList.add("hidden");
        }
    });

    function toggleUserDropdown() {
        document.getElementById("userDropdownMenu").classList.toggle("hidden");
    }
</script>

</body>
</html>
