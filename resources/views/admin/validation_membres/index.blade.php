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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Validation des Membres</h2>
    </div>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tableau --}}
    @if($demandes->isEmpty())
        <div class="alert alert-info">
            Aucune demande d'adhésion en attente.
        </div>
    @else
        <div class="table-responsive shadow-sm border rounded">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nom utilisateur</th>
                        <th>Email</th>
                        <th>Tontine demandée</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandes as $demande)
                        <tr>
                            <td>{{ $demande->nom_user }}</td>
                            <td>{{ $demande->email }}</td>
                            <td>{{ $demande->nom_tontine }}</td>
                            <td>
                                @if($demande->statut === 'en attente')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif($demande->statut === 'acceptée')
                                    <span class="badge bg-success">Acceptée</span>
                                @elseif($demande->statut === 'refusée')
                                    <span class="badge bg-danger">Refusée</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <form method="POST" action="{{ route('admin.validation_membres.valider', $demande->demande_id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-check-lg"></i> Accepter
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.validation_membres.refuser', $demande->demande_id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-lg"></i> Refuser
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
