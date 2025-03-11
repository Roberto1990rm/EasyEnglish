<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'EasyEnglish')</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="http∫s://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/cursoBasicoShow.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    </head>
    


<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/favicon.png') }}" alt="EasyEnglish Logo" width="40" height="40">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
                       <!-- Left Side Of Navbar -->
                       <ul class="navbar-nav me-auto">

                       </ul>
   
                       <!-- Right Side Of Navbar -->
                       <ul class="navbar-nav ms-auto">
                           <!-- Authentication Links -->
                           @guest
                               @if (Route::has('login'))
                                   <li class="nav-item">
                                       <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                   </li>
                               @endif
   
                               @if (Route::has('register'))
                                   <li class="nav-item">
                                       <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                   </li>
                               @endif
                           @else
                               <li class="nav-item dropdown">
                                   <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                       {{ Auth::user()->name }}
                                   </a>
   
                                   <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                       <a class="dropdown-item" href="{{ route('logout') }}"
                                          onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                           {{ __('Logout') }}
                                       </a>
   
                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                           @csrf
                                       </form>
                                   </div>
                               </li>
                           @endguest
                       </ul>
            </div>
            

        </div>

    </nav>

    <!-- Main Content -->
    <div class=" mt-4" style="padding-bottom: 100px;">
        @yield('content') <!-- Esto permitirá que se muestre el contenido de cada vista -->
    </div>

    <!-- Footer -->
    <footer class="fixed-bottom">
        <p>&copy; 2025 EasyEnglish. Todos los derechos reservados.</p>
        <p><a href="#" class="footer-link">Política de privacidad</a> | <a href="#" class="footer-link">Términos de servicio</a></p>
    </footer>

    <!-- Bootstrap JS (Opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
