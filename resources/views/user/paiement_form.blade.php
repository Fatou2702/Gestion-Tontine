@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-success">💳 Effectuer mon paiement</h2>
        <p class="text-muted">Choisissez un opérateur de paiement et confirmez votre paiement.</p>
    </div>

    <div class="card shadow p-4 mx-auto" style="max-width: 550px; border-radius: 16px;">
        <h5 class="mb-3">
            <span class="text-secondary">Tontine :</span>
            <strong>{{ $tontine->nom }}</strong>
        </h5>
        <h6 class="mb-4">
            <span class="text-secondary">Montant :</span>
            <strong class="text-dark">{{ number_format($montant, 0, ',', ' ') }} FCFA</strong>
        </h6>

        <form method="POST" action="{{ route('paiement.valider', $tontine) }}">
            @csrf

            <h6 class="mb-3 fw-semibold">Choisissez un opérateur :</h6>

            <div class="row g-3 mb-4">
                @php
                    $operateurs = [
                        ['wave', 'Wave', 'primary'],
                        ['orange-money', 'Orange Money', 'warning'],
                        ['free-money', 'Free Money', 'danger'],
                        ['wari', 'Wari', 'success'],
                    ];
                @endphp

                @foreach($operateurs as [$value, $label, $color])
                    <div class="col-6">
                        <button type="submit" name="operateur" value="{{ $value }}" class="btn btn-outline-
                        {{ $color }} w-100 py-3 d-flex flex-column align-items-center" style="border-radius: 12px;">
                            <img src="/images/{{ $value }}.png" alt="{{ $label }}" width="40" class="mb-2">
                            {{ $label }}
                        </button>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success w-100 py-2 fw-semibold" style="border-radius: 8px;">
                <i class="bi bi-check-circle me-1"></i> Confirmer le paiement
            </button>
        </form>
    </div>
</div>
@endsection
