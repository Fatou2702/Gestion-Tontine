<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tableau de bord Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #198754;
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #157347;
        }

        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }

        footer {
            background-color: white;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    
    {{-- Sidebar --}}
    <div class="sidebar">
        <h4 class="text-center py-4 border-bottom">  
           {{ auth()->user()->name }}
        </h4>

        <a href="{{ route('user.dashboard') }}"><i class="bi bi-house"></i> Tableau de bord</a>
        <a href=" "><i class="bi bi-people-fill"></i> Mes Tontines</a>

    </div>

    {{-- Main content --}}
    <div class="main-content">
        {{-- Header --}}
        <nav class="navbar navbar-light bg-white shadow-sm px-4">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <span class="navbar-brand mb-0 h4">Tableau de bord Utilisateur</span>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown" style="color: black">
                   <i class="bi bi-person-circle" style="font-size: 2rem; cursor: pointer;"></i> 
               </a>

                <div class="dropdown-menu dropdown-menu-end p-3 text-center">
                    <div class="mb-2">
                        <i class="bi bi-person me-2" style="color: black"></i> 
                   </div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <div class="text-muted small">{{ Auth::user()->email }}</div>
                    <div class="text-muted small">{{ Auth::user()->phone }}</div>

                    <hr>

                    <a href=" " class="dropdown-item" >
                        <i class="bi bi-person me-2"  ></i> Mon Profil
                    </a>

                    <a href="#" class="dropdown-item">
                        <i class="bi bi-key me-2"></i> Changer mot de passe
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>

            </div>
        </nav>

        {{-- Page Content --}}
        <main class="content">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="text-center py-2 text-muted">
            © 2025 e-Tontine. Tous droits réservés.
        </footer>
    </div>
    <div class="sidebar">
    <h4 class="text-center py-4 border-bottom">  
        {{ auth()->user()->name }}
    </h4>

    <a href="{{ route('user.dashboard') }}"><i class="bi bi-house"></i> Tableau de bord</a>
    <a href="{{ route('user.calendar') }}"> Calendrier des paiements</a>
    <a href="{{ route('user.payment.history') }}"> Historiques paiements</a>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Déconnexion
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
