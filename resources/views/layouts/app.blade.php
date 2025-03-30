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
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&family=Bungee+Tint&family=Honk&family=Tektur:wght@400..900&display=swap"
    rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    @vite('resources/js/app.js')




    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="flex flex-col min-h-screen bg-gray-100">

    <nav class=" shadow-md fixed w-full z-50">
        <div style="font-size: 13.5px;" class="boldonse-regular max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ url('/') }}">
                    <img style="border-radius: 5px; opacity: 0.88;" src="{{ asset('images/logo1.png') }}"
                        alt="EasyEnglish Logo" class="h-10">
                </a>

                <!-- Menú Escritorio con textos -->
                <div style="text-shadow: rgb(132, 151, 132) 2px 2px 4px; font-size: 12px;"
                    class="hidden md:flex space-x-4 boldonse-regular">
                    <a style="background-color: rgb(246, 207, 133);" href="{{ url('/') }}"
                    class="menu-icon text-gray-700 hover:bg-gray-50">
                    <i class="bi bi-house-door-fill"></i>
                    <span class="tooltip">Inicio</span>
                </a>
                <a style="background-color: rgb(119, 233, 132);" href="{{ route('courses.index') }}"
                    class="menu-icon text-gray-700 hover:bg-gray-50">
                    <i class="bi bi-book-fill"></i>
                    <span class="tooltip">Cursos</span>
                </a>


                <a style="background-color: rgb(234, 118, 236);" href="{{ route('contact.show') }}"
                    class="menu-icon text-gray-700 hover:bg-gray-50">
                    <i class="bi bi-envelope-fill"></i>
                    <span class="tooltip">Contacto</span>
                </a>

                <a style="background-color: rgb(250, 250, 250);" class="menu-icon text-gray-700 hover:bg-gray-50"
                    href="{{ route('pronunciacion') }}">
                    🗣️ <span class="tooltip">Pronunciation</span>
                </a>
                </div>

                <!-- Menú Móvil con Iconos y Etiquetas -->
                <div class="flex md:hidden justify-around items-center space-x-2">
                    <a style="background-color: rgb(237, 197, 124);" href="{{ url('/') }}"
                        class="menu-icon text-gray-700 hover:bg-gray-50">
                        <i class="bi bi-house-door-fill"></i>
                        <span class="tooltip">Inicio</span>
                    </a>
                    <a style="background-color: rgb(145, 237, 156);" href="{{ route('courses.index') }}"
                        class="menu-icon text-gray-700 hover:bg-gray-50">
                        <i class="bi bi-book-fill"></i>
                        <span class="tooltip">Cursos</span>
                    </a>


                    <a style="background-color: rgb(239, 132, 241);" href="{{ route('contact.show') }}"
                        class="menu-icon text-gray-700 hover:bg-gray-50">
                        <i class="bi bi-envelope-fill"></i>
                        <span class="tooltip">Contacto</span>
                    </a>

                    <a style="background-color: rgb(250, 250, 250);" class="menu-icon text-gray-700 hover:bg-gray-50"
                        href="{{ route('pronunciacion') }}">
                        🗣️ <span class="tooltip">Pronunciation</span>
                    </a>
                </div>








                <div class="relative flex items-center">
                    @auth
                        <div>
                            @livewire('unread-messages-icon')
                        </div>
                        <button id="userDropdownBtn" class="flex items-center space-x-2 text-gray-700 hover:text-blue-500">
                            <i class="hidden md:inline  bi bi-person-circle text-xl"></i>
                            <span class="flex items-center gap-1">
                                {{ auth()->user()->name }}
                                @if (auth()->user()->subscriber)
                                    <span class="text-blue-400" title="Usuario Premium">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                @endif
                            </span>
                            <i class="bi bi-chevron-down"></i>
                        </button>

                        <div style="text-shadow: rgb(106, 104, 104) 1px 1px 2px;" id="userDropdown"
                            class="tektur absolute right-0 top-full mt-2 w-48 bg-white rounded-md shadow-lg hidden z-50">
                            @if (auth()->user()->admin)
                                <div class="px-4 py-2 text-sm text-gray-500">Admin</div>
                                <a href="{{ route('courses.create') }}" class="block px-4 py-2 hover:bg-gray-100">Crear
                                    curso</a>
                                <a href="{{ route('lessons.create') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    Crear Lección
                                </a>
                                <a href="{{ route('courses.index') }}" class="block px-4 py-2 hover:bg-gray-100">Gestionar
                                    cursos</a>
                                <div class="border-t my-1"></div>
                            @endif

                            <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Mi Perfil</a>


                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 hover:bg-gray-100">Logout</button>
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
    @livewire('chat-component')

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
