@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="login-box shadow-lg rounded p-4 bg-white mx-auto" style="max-width: 500px;">

        <!-- Entête avec icône + titre -->
        <div class="d-flex align-items-center mb-4">
            <a href="{{ url('/') }}" class="me-2 text-decoration-none text-dark">
                <i class="bi bi-arrow-left-circle-fill" style="color: #158765; font-size: 30px;"></i>
            </a>
            <h2 class="mb-0 text-success">Se connecter</h2>
        </div>

        <!-- Affichage message d'erreur -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Affichage message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Adresse email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Mot de passe</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Se souvenir de moi</label>
            </div>

            <button type="submit" class="btn w-100 text-white fw-semibold" style="background-color: #158765;">
                <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
            </button>

            <div class="text-center mt-3">
                <a href="#" class="text-decoration-none" style="color: #158765;">
                    Mot de passe oublié ?
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
