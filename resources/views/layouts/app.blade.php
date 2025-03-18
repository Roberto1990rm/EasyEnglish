<!-- resources/views/layouts/main.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EasyEnglish')</title>
     <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="http∫s://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
    <!-- Navbar -->
    <nav style="height: 40px;" class="shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center mb-4">
                    <a href="/" class="text-xl font-bold text-gray-800">MyWebsite</a>
                </div>
                <div class="flex items-center hidden md:flex space-x-4">
                    <a href="#" class="text-gray-600 hover:text-blue-600">Home</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">About</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Services</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Contact</a>
                </div>
                <div class="relative mt-2">
                    <!-- Botón -->
                    <button id="menuButton" onclick="toggleMenu()" class="text-gray-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                
                    <!-- Menú desplegable -->
                    <div id="mobileMenu" class="absolute right-0 w-auto bg-white shadow-md p-4 rounded-lg hidden">
                        <a href="#" class="block px-4 py-2 text-gray-600 hover:text-blue-600 whitespace-nowrap">Home</a>
                        <a href="#" class="block px-4 py-2 text-gray-600 hover:text-blue-600 whitespace-nowrap">About</a>
                        <a href="#" class="block px-4 py-2 text-gray-600 hover:text-blue-600 whitespace-nowrap">Services</a>
                        <a href="#" class="block px-4 py-2 text-gray-600 hover:text-blue-600 whitespace-nowrap">Contact</a>
                    </div>
                </div>
            </div>
        
        <!-- Mobile Menu -->
      
    </nav>

    <!-- Contenido de la página -->
    <main class="flex-grow pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center  mt-auto">
        <h1>Hola</h1>
    </footer>

    <script>
        function toggleMenu() {
            let menu = document.getElementById("mobileMenu");
            menu.classList.toggle("hidden");
        }
    
        // Cerrar el menú si se hace clic fuera
        document.addEventListener("click", function(event) {
            let menu = document.getElementById("mobileMenu");
            let button = document.getElementById("menuButton");
    
            // Verifica si el clic fue fuera del menú y del botón
            if (!menu.contains(event.target) && !button.contains(event.target)) {
                menu.classList.add("hidden");
            }
        });
    </script>
</body>

</html>
