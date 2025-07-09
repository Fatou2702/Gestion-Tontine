@extends('layouts.user')

@section('content')
<div class="container py-4">

    {{-- Messages de succès ou d'erreur --}}
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Mes Tontines</h2>
    </div>

    <div class="mb-4 text-end">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#rejoindreTontineModal">
            + Rejoindre une Tontine
        </button>
    </div>

    @if($tontines->count() > 0)

        @php
            // Tableau de couleurs différentes
            $bgColors = [
                '#e7f5f9', // Bleu clair
                '#e9fbe9', // Vert clair
                '#fdf3f9', // Rose clair
                '#fff3cd', // Jaune clair
                '#f8d7da', // Rouge clair
                '#e0f7fa', // Turquoise
                '#f0f4c3', // Vert anis
            ];
        @endphp

        <div class="row g-4">
            @foreach($tontines as $index => $tontine)
                @php
                    $bgColor = $bgColors[$index % count($bgColors)];
                @endphp

                <div class="col-md-6">
                    <div class="card shadow-sm h-100 border-0" style="border-radius: 16px; background: {{ $bgColor }}; padding: 20px;">
                        <h5 class="fw-bold mb-3">{{ $tontine->nom }}</h5>

                        <p class="fs-5 fw-semibold mb-2 text-dark">
                            {{ number_format($tontine->montant, 0, ',', '.') }} FCFA
                        </p>

                        <div class="d-flex flex-wrap mb-3" style="gap: 12px;">
                            <div class="d-flex align-items-center gap-1 text-secondary">
                                <i class="bi bi-currency-dollar"></i> {{ ucfirst($tontine->frequence) }}
                            </div>
                            <div class="d-flex align-items-center gap-1 text-secondary">
                                <i class="bi bi-people"></i> {{ $tontine->users_count }} Personnes
                            </div>
                            <div class="d-flex align-items-center gap-1 text-secondary">
                                <i class="bi bi-shuffle"></i> {{ $tontine->methode_attribution }}
                            </div>
                        </div>

                        {{-- LE BOUTON EFFECTUER UN PAIEMENT --}}
                        <a href="{{ route('paiement.form', $tontine) }}" class="btn btn-outline-success w-100" style="border-radius: 12px;">
                            Effectuer un paiement
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="alert alert-info text-center mt-5">
            Vous ne participez à aucune tontine pour le moment.
        </div>
    @endif
</div>

<!-- Modal pour rejoindre une tontine -->
<div class="modal fade" id="rejoindreTontineModal" tabindex="-1" aria-labelledby="rejoindreTontineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('user.tontines.join') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Rejoindre une tontine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label for="tontine_id" class="form-label">Sélectionner une tontine</label>
                <select name="tontine_id" id="tontine_id" class="form-select" required>
                    <option value=""></option>
                    @forelse($tontinesDisponibles ?? [] as $tontine)
                        <option value="{{ $tontine->id }}">
                            {{ $tontine->nom }} ({{ number_format($tontine->montant, 0, ',', '.') }} FCFA - {{ $tontine->frequence }})
                        </option>
                    @empty
                        <option value="" disabled>😢 Aucune tontine disponible actuellement</option>
                    @endforelse
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-success">Rejoindre</button>
            </div>
        </form>
    </div>
</div>
@endsection
