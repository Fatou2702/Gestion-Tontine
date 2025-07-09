@extends('layouts.user')

@section('content')
<div class="container my-4">

    <h2 class="mb-4 text-center">📜 Historique de mes paiements</h2>

    {{-- Filtre --}}
    <div class="mb-3 text-center">
        <label class="me-2">Filtrer par tontine :</label>
        <select id="filterTontine" class="form-select d-inline w-auto">
            <option value="all">Toutes</option>
            @foreach($tontines as $tontine)
                <option value="{{ $tontine->nom }}">{{ $tontine->nom }}</option>
            @endforeach
        </select>
    </div>

    {{-- Listes de cartes --}}
    <div id="historyList">
        @foreach($historique as $paiement)
            @php
                $date = \Carbon\Carbon::parse($paiement['date']);
                $aujourdhui = \Carbon\Carbon::now()->startOfDay();
                $hier = \Carbon\Carbon::yesterday()->startOfDay();
            @endphp

            {{-- Séparateur Aujourd'hui / Hier / Autre --}}
            @if($loop->first || $previousDate != $date->format('Y-m-d'))
                <h5 class="mt-4 mb-3">
                    @if($date->isSameDay($aujourdhui))
                        Aujourd'hui
                    @elseif($date->isSameDay($hier))
                        Hier
                    @else
                        {{ $date->format('d F Y') }}
                    @endif
                </h5>
            @endif

            {{-- Carte --}}
            <div class="card mb-3 p-3 shadow-sm" data-tontine="{{ $paiement['tontine_nom'] }}"
                style="border-left: 5px solid 
                    @if($paiement['type'] === 'reception') #2ecc71
                    @elseif($paiement['statut'] === 'En retard') #f39c12
                    @else #3498db
                    @endif">

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="fw-bold">
                        @if($paiement['type'] === 'reception')
                            {{ $paiement['tour'] }}e tour
                        @endif
                    </div>
                    <div>
                        @if($paiement['type'] === 'reception')
                            <span class="text-success fw-bold">
                                + {{ number_format($paiement['montant'], 0, ',', ' ') }} FCFA
                            </span>
                        @else
                            <span class="text-danger fw-bold">
                                - {{ number_format($paiement['montant'], 0, ',', ' ') }} FCFA
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mb-1">
                    {{ $paiement['tontine_nom'] }}
                </div>

                <div class="d-flex align-items-center text-muted">
                    @if($paiement['type'] === 'reception')
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        Réception le {{ $date->format('d M Y') }}
                    @elseif($paiement['statut'] === 'Payé')
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        Payé le {{ $date->format('d M Y') }}
                    @else
                        <i class="bi bi-exclamation-circle-fill text-warning me-2"></i>
                        En retard ({{ $date->format('d M Y') }})
                    @endif
                </div>

            </div>

            @php $previousDate = $date->format('Y-m-d'); @endphp
        @endforeach
    </div>

</div>

{{-- JS filtre --}}
<script>
    document.getElementById('filterTontine').addEventListener('change', function () {
        const selected = this.value;
        const cards = document.querySelectorAll('#historyList .card');

        cards.forEach(card => {
            card.style.display = (selected === 'all' || card.dataset.tontine === selected) ? '' : 'none';
        });
    });
</script>
@endsection
