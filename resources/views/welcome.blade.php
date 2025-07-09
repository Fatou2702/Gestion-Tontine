@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">

    <!-- Image circulaire -->
    <img 
        src="{{ asset('images/main.png') }}" 
        alt="Logo e-Tontine" 
        class="rounded-circle mb-4 shadow"
        style="width: 180px; height: 180px; object-fit: cover;">

    <!-- Titre de bienvenue -->
    <h1 class="fw-bold text-dark mb-3">
        Bienvenue sur<br>e-Tontine
    </h1>

    <!-- Slogan ou texte d'intro -->
    <p class="text-muted mb-4">
        Gérez vos tontines en toute simplicité et sécurité.
    </p>

    <!-- Boutons Connexion et Inscription -->
    <div class="d-flex justify-content-center flex-wrap gap-3 mt-3">
        <a href="{{ route('login') }}" class="btn px-4 py-2 text-white fw-semibold" style="background-color: #158765;">
            Connexion
        </a>
        <a href="{{ route('register') }}" class="btn btn-outline-success px-4 py-2 fw-semibold" style="border-color: #158765; color: #158765;">
            S’inscrire
        </a>
    </div>
</div>
@endsection
