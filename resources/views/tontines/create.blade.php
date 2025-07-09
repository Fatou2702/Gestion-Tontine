@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    {{-- Cartes statistiques --}}
    <div class="row g-4 mb-4">
        {{-- Carte Ventes --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted">Nombre de tontines</h6>
                        <h3 class="fw-bold">5</h3>
                        <div class="small text-success">+12% d'augmentation</div>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-collection fs-3 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
       {{-- Carte Revenus --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted">Nombre de membres</h6>
                        <h3 class="fw-bold">3</h3>
                        <div class="small text-success">+8% ce mois</div>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-people fs-3 text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        {{-- Carte Montant --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted">Montant total cotisé</h6>
                        <h3 class="fw-bold">100 000 FCFA</h3>
                        <div class="small text-success">+5% ce mois</div>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-currency-dollar fs-3 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Formulaire --}}
    <div class="mx-auto shadow-lg rounded p-4 bg-white" style="max-width: 850px;">

        {{-- Titre --}}
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('tontines.index') }}" class="me-2 text-decoration-none">
                <i class="bi bi-arrow-left-circle-fill text-success fs-2"></i>
            </a>
            <h2 class="mb-0 fw-bold text-success">Nouvelle tontine</h2>
        </div>

        {{-- Erreurs --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('tontines.store') }}">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nom de la tontine</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Montant (FCFA)</label>
                    <input type="number" name="montant" class="form-control" value="{{ old('montant') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Fréquence</label>
                    <select name="frequence" class="form-select" required>
                        <option value="">-- Choisir --</option>
                        <option value="Hebdomadaire" {{ old('frequence') == 'Hebdomadaire' ? 'selected' : '' }}>Hebdomadaire</option>
                        <option value="Bihebdomadaire" {{ old('frequence') == 'Bihebdomadaire' ? 'selected' : '' }}>Bihebdomadaire</option>
                        <option value="Mensuelle" {{ old('frequence') == 'Mensuelle' ? 'selected' : '' }}>Mensuelle</option>
                        <option value="Trimestrielle" {{ old('frequence') == 'Trimestrielle' ? 'selected' : '' }}>Trimestrielle</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Méthode d’attribution</label>
                    <select name="methode_attribution" class="form-select" required>
                        <option value="">-- Choisir --</option>
                        <option value="Aléatoire" {{ old('methode_attribution') == 'Aléatoire' ? 'selected' : '' }}>Aléatoire</option>
                        <option value="Ordre fixe" {{ old('methode_attribution') == 'Ordre fixe' ? 'selected' : '' }}>Ordre fixe</option>
                        <option value="Vote" {{ old('methode_attribution') == 'Vote' ? 'selected' : '' }}>Vote</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date de début</label>
                    <input type="date" name="date_debut" class="form-control" value="{{ old('date_debut') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date de fin</label>
                    <input type="date" name="date_fin" class="form-control" value="{{ old('date_fin') }}" required>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn w-100 text-white fw-semibold" style="background-color: #158765;">
                        <i class="bi bi-check-circle me-1"></i>Créer la tontine
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
