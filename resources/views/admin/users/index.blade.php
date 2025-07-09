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

    {{-- Titre du tableau --}}
    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <h2 class="fw-bold mb-0">Liste des Membres</h2>
    </div>

    {{-- Tableau des utilisateurs --}}
    <div class="table-responsive shadow-sm border rounded">
        <table class="table align-middle table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Avancement des paiements</th>
                    <th>Inscrit le</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @php
                        $progress = rand(0, 100);
                    @endphp
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td style="min-width: 200px;">
                            <div class="progress" style="height: 20px; border-radius: 10px;">
                                <div class="progress-bar {{ $progress >= 100 ? 'bg-success' : 'bg-success' }}"
                                     role="progressbar"
                                     style="width: {{ $progress }}%;"
                                     aria-valuenow="{{ $progress }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                    {{ $progress }}%
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
