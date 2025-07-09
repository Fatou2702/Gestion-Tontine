
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Tontine</title>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="bg-white d-flex flex-column min-vh-100">

    <!-- Header -->
    <header class="py-3 bg-app text-white text-center shadow-sm">
        <h1 class="h4 mb-0 fw-bold">e-Tontine</h1>
    </header>

    <!-- Main content with flex grow -->
    <main class="flex-grow-1 d-flex justify-content-center align-items-center text-center">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-2 text-muted bg-white border-top">
        © 2025 e-Tontine. Tous droits réservés.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
