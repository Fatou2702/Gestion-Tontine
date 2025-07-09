@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="shadow-lg rounded p-4 bg-white mx-auto" style="max-width: 500px;">

        <!-- Entête avec icône et titre -->
        <div class="d-flex align-items-center mb-4">
            <a href="{{ url('/') }}" class="me-2 text-decoration-none text-dark">
                <i class="bi bi-arrow-left-circle-fill" style="color:#158765; font-size: 30px;"></i>
            </a>
            <h2 class="mb-0 text-success">Créer un compte</h2>
        </div>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nom complet</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Téléphone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Confirmation du mot de passe</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn w-100 text-white fw-semibold" style="background-color:#158765;">
                <i class="bi bi-person-plus me-1"></i> S’inscrire
            </button>

            <!-- Politique de confidentialité -->
            <p class="text-muted mt-3 mb-0 text-center" style="font-size: 0.9rem;">
                En vous inscrivant, vous acceptez nos
                <a href="#" class="text-decoration-none" style="color:#158765;">Conditions d'utilisation</a> et notre
                <a href="#" class="text-decoration-none" style="color:#158765;">Politique de confidentialité</a>.
            </p>
        </form>
    </div>
</div>
@endsection
