@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4 fw-bold">Tableau de bord</h2>

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

    {{-- Ligne suivante --}}
    <div class="row g-4 mt-4">
        {{-- Carte Tontines en cours --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted">Tontines en cours</h6>
                        <h3 class="fw-bold">{{ $nombreTontinesEnCours }}</h3>
                        <div class="small text-info">Actives</div>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-play-circle fs-3 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        {{-- Carte Paiements en retard --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted">Paiements en retard</h6>
                        <h3 class="fw-bold">3</h3>
                        <div class="small text-danger">Attention</div>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-exclamation-triangle fs-3 text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
        {{-- Carte Demandes de validation --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted">Demandes de validation</h6>
                        <h3 class="fw-bold">1</h3>
                        <div class="small text-primary">En attente</div>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-hourglass-split fs-3 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Historique et Prochains tours --}}
    <div class="row g-4 mt-4">
        {{-- Historique des actions récentes --}}
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Historique des actions récentes</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Elzo N. a été suspendu</li>
                        <li class="list-group-item">Oumar G. a été expulsé</li>
                        <li class="list-group-item">Aissatou B. a reçu son tour</li>
                        <li class="list-group-item">Seydou D. a rejoint une tontine</li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- Prochains tours de réception --}}
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Prochains tours de réception</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Assane K.</span>
                            <span>17 juin 2024</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Aliou D.</span>
                            <span>20 juin 2024</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Awa F.</span>
                            <span>23 juin 2024</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<footer class="bg-light text-center text-lg-start mt-4">
    <div class="text-center p-3">
        © {{ date('Y') }} FashaTontine. Tous droits réservés.
    </div>
</footer>
@endsection
