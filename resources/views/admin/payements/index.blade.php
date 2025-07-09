@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <!-- Statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Paiements effectués</h6>
                    <h3 class="fw-bold text-success">{{ $stats['payes'] ?? 0 }}</h3>
                    <div class="small text-success">✔ À jour</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Paiements en retard</h6>
                    <h3 class="fw-bold text-warning">{{ $stats['retard'] ?? 0 }}</h3>
                    <div class="small text-warning">⏳ Attention</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Paiements non effectués</h6>
                    <h3 class="fw-bold text-danger">{{ $stats['non_payes'] ?? 0 }}</h3>
                    <div class="small text-danger">✘ Non payé</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des paiements -->
    <div class="card shadow">
        <div class="card-header bg-success text-white fw-bold">
            Liste des paiements
        </div>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Nom tontine</th>
                        <th>Montant</th>
                        <th>Date prévue</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paiements as $paiement)

                        @php
                            // Couleur de la ligne selon le statut
                            $classe = match($paiement->statut) {
                                'paye' => 'table-success',
                                'en_retard' => 'table-warning',
                                'non_paye' => 'table-danger',
                                default => '',
                            };

                            // Texte affiché
                            $texte = match($paiement->statut) {
                                'paye' => 'Payé',
                                'en_retard' => 'Payé en retard',
                                'non_paye' => 'Non payé',
                                default => ucfirst($paiement->statut),
                            };
                        @endphp
                        <tr class="{{ $classe }}">
                            <td>{{ $paiement->id }}</td>
                            <td>{{ $paiement->user->name }}</td>
                            <td>{{ $paiement->tontine->nom }}</td>
                            <td>{{ number_format($paiement->montant,0,',','.') }} FCFA</td>
                            <td>{{ \Carbon\Carbon::parse($paiement->date_prevue)->format('d/m/Y') }}</td>
                            <td><span class="fw-semibold">{{ $texte }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Aucun paiement enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
