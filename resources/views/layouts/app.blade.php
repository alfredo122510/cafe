<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Enlace a la biblioteca Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-BYa5zYvKUq7+LclY5Zjx8DuyTo3Q4D2KX1oKYmV1Ye5/2zvCJlHjPUGSL5oRmGWuDOe2jswsq80HbbyCWj6Ixg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Estilos personalizados -->
    <style>
        body, html {
            height: 100%;
        }
        .full-height {
            height: 100%;
        }
        .navbar-brand i {
            margin-right: 5px;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Barra de navegación Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.entregas') }}">Entregas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.compras') }}">Compras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.productos') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.finDeMes') }}">Ver Resumen del Mes</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid full-height">
        @yield('content')
    </div>

    <!-- Enlaces a los scripts de Bootstrap (jQuery y Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    
</body>
</html>
