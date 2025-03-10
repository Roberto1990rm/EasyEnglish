<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EasyEnglish')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS (Opcional) -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .hero {
            background: url('https://via.placeholder.com/1920x800?text=EasyEnglish') no-repeat center center;
            background-size: cover;
            height: 80vh;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
        }
        .cta-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 1.25rem;
            border-radius: 5px;
            text-decoration: none;
        }
        .cta-btn:hover {
            background-color: #0056b3;
        }
        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }
        .footer-link {
            color: #007bff;
            text-decoration: none;
        }
        .footer-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">EasyEnglish</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="hero">
        <div class="text-center">
            <h1>¡Aprende inglés fácil y rápido!</h1>
            <p class="lead">Únete a nuestra plataforma y mejora tus habilidades lingüísticas de forma efectiva y divertida.</p>
            <a href="#cursos" class="cta-btn">Explora nuestros cursos</a>
        </div>
    </div>

    <div class="container my-5" id="cursos">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="https://via.placeholder.com/500x300?text=Curso+de+Ingl%C3%A9s" class="card-img-top" alt="Curso de Inglés">
                    <div class="card-body">
                        <h5 class="card-title">Curso Básico de Inglés</h5>
                        <p class="card-text">Aprende los conceptos básicos del inglés con clases interactivas y dinámicas.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="https://via.placeholder.com/500x300?text=Curso+de+Ingl%C3%A9s+Intermedio" class="card-img-top" alt="Curso Intermedio de Inglés">
                    <div class="card-body">
                        <h5 class="card-title">Curso Intermedio de Inglés</h5>
                        <p class="card-text">Amplía tus conocimientos del inglés con lecciones y ejercicios de nivel intermedio.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="https://via.placeholder.com/500x300?text=Curso+de+Ingl%C3%A9s+Avanzado" class="card-img-top" alt="Curso Avanzado de Inglés">
                    <div class="card-body">
                        <h5 class="card-title">Curso Avanzado de Inglés</h5>
                        <p class="card-text">Perfecciona tu inglés con clases avanzadas centradas en fluidez y comprensión.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 EasyEnglish. Todos los derechos reservados.</p>
        <p><a href="#" class="footer-link">Política de privacidad</a> | <a href="#" class="footer-link">Términos de servicio</a></p>
    </footer>

    <!-- Bootstrap JS (Opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
