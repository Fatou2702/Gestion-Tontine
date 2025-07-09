<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Tableau de bord</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
      background-color: #f6f9ff;
    }
    .sidebar {
      width: 240px;
      background: #158765; /* fond vert */
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      padding-top: 20px;
      z-index: 1000;
    }
    .sidebar .nav-link {
      color: #ffffff; /* texte blanc */
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      border-left: 3px solid transparent;
      transition: background 0.2s, border 0.2s;
    }
    .sidebar .nav-link:hover {
      background: #117255; /* vert plus foncé au survol */
      color: #ffffff;
    }
    .sidebar .nav-link.active {
      background: #1da876; /* vert clair actif */
      border-left: 3px solid #ffffff;
      color: #ffffff;
      font-weight: 500;
    }
    .main-content {
      margin-left: 240px;
      flex: 1;
    }
    .navbar {
      background: white;
    }
    footer {
      background: white;
    }
    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
        border-right: none;
        border-bottom: 1px solid #ddd;
      }
      .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <nav class="sidebar d-flex flex-column">
    <div class="text-center mb-3">
      <h4 class="fw-bold mt-2">E-Tontine</h4>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i class="bi bi-speedometer2"></i> Tableau de bord
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
          <i class="bi bi-people-fill"></i> Membres
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('tontines.index') }}" class="nav-link {{ request()->routeIs('tontines.index') ? 'active' : '' }}">
          <i class="bi bi-piggy-bank-fill"></i> Tontines
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.paiements.index') }}" class="nav-link">
          <i class="bi bi-wallet-fill"></i> Paiements
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.validation_membres.index') }}" class="nav-link {{ request()->routeIs('admin.validation_membres.index') ? 'active' : '' }}">
          <i class="bi bi-check-circle"></i> Validation Membres
        </a>
      </li>
      <li class="nav-item mt-auto">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
          </button>
        </form>
      </li>
    </ul>
  </nav>

  <!-- Main Content -->
  <div class="main-content d-flex flex-column min-vh-100">
    <nav class="navbar shadow-sm px-4">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h5">Admin Panel</span>
        <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar">
          <i class="bi bi-list"></i>
        </button>
      </div>
    </nav>

    <main class="flex-fill p-4">
      @yield('content')
    </main>

    <footer class="text-center py-2 text-muted border-top">
      © {{ date('Y') }} FashaTontine. Tous droits réservés.
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
