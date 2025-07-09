@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- Cartes statistiques --}}
    <div class="row g-4">
        {{-- Carte Ventes --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted">Nombre de tontines</h6>
                        <h3 class="fw-bold">{{ $nombreTontines }}</h3>
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
                        <h3 class="fw-bold">{{ $nombreUsers }}</h3>
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

    {{-- Titre --}}
    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <h2 class="fw-bold mb-0">Liste des Tontines</h2>
        <a href="{{ route('tontines.create') }}" class="btn btn-success fw-semibold">
            <i class="bi bi-plus-circle me-1"></i> Ajouter une tontine
        </a>
    </div>

    {{-- Filtres --}}
    <form method="GET" action="{{ route('tontines.index') }}" class="row g-3 align-items-end mb-4">
        <div class="col-md-3">
            <label for="frequence" class="form-label">Fréquence</label>
            <select name="frequence" id="frequence" class="form-select">
                <option value="">Toutes</option>
                <option value="Hebdomadaire" {{ request('frequence') == 'Hebdomadaire' ? 'selected' : '' }}>Hebdomadaire</option>
                <option value="Bihebdomadaire" {{ request('frequence') == 'Bihebdomadaire' ? 'selected' : '' }}>Bihebdomadaire</option>
                <option value="Mensuelle" {{ request('frequence') == 'Mensuelle' ? 'selected' : '' }}>Mensuelle</option>
                <option value="Trimestrielle" {{ request('frequence') == 'Trimestrielle' ? 'selected' : '' }}>Trimestrielle</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="date" class="form-label">Date de début</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-success w-100">
                <i class="bi bi-funnel me-1"></i> Filtrer
            </button>
        </div>
    </form>

    {{-- Tableau --}}
    <div class="table-responsive shadow-sm border rounded">
        <table class="table align-middle table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Montant</th>
                    <th>Fréquence</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Méthode attribution</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tontines as $tontine)
                    @php
                        $estTerminee = \Carbon\Carbon::parse($tontine->date_fin)->isPast();
                        $statut = $estTerminee ? 'Terminée' : 'En cours';
                    @endphp
                    <tr class="{{ $estTerminee ? 'table-danger' : '' }}">
                        <td>{{ $tontine->nom }}</td>
                        <td>{{ number_format($tontine->montant, 0, ',', '.') }} FCFA</td>
                        <td>{{ $tontine->frequence }}</td>
                        <td>{{ $tontine->date_debut }}</td>
                        <td>{{ $tontine->date_fin }}</td>
                        <td>{{ $tontine->methode_attribution }}</td>
                        <td>
                            <span class="badge {{ $estTerminee ? 'bg-danger' : 'bg-success' }}">
                                {{ $statut }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('tontines.show', $tontine->id) }}"
                               class="btn btn-outline-success btn-sm">
                                Voir
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center" class="btn btn-outline-success btn-sm>
        {{ $tontines->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
