@extends('layouts.user')

@section('content')
<div class="container my-5">

    <h2 class="mb-4 text-center">📅 Mon calendrier de paiements</h2>

    {{-- Filtres --}}
    <div class="mb-4 text-center">
        <label for="filterTontine" class="form-label me-2">Filtrer par tontine :</label>
        <select id="filterTontine" class="form-select d-inline w-auto">
            <option value="all">Toutes</option>
            @foreach(collect($paiements)->pluck('tontine_nom')->unique() as $tontineNom)
                <option value="{{ $tontineNom }}">{{ $tontineNom }}</option>
            @endforeach
        </select>
    </div>

    {{-- Navigation Mois --}}
    <div class="mb-4 text-center">
        <button class="btn btn-secondary me-2" id="prevMonth">← Mois précédent</button>
        <button class="btn btn-secondary" id="nextMonth">Mois suivant →</button>
    </div>

    {{-- Calendrier --}}
    <div id="calendar" class="table-responsive"></div>

    {{-- Légende --}}
    <div class="mt-4">
        <h5>Légende :</h5>
        <ul class="list-unstyled">
            @foreach(collect($paiements)->unique('tontine_nom') as $p)
                <li>
                    <span style="display:inline-block; width:15px; height:15px; background:{{ $p['color'] }}; margin-right:5px;"></span>
                    {{ $p['tontine_nom'] }}
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Liste des paiements prévus --}}
    @if(count($paiements) > 0)
        <div class="mt-5">
            <h5>🔔 Prochains paiements :</h5>
            <ul>
                @foreach($paiements as $paiement)
                    <li style="color: {{ $paiement['color'] }};">
                        {{ \Carbon\Carbon::parse($paiement['date'])->format('d F Y') }}
                        — {{ $paiement['tontine_nom'] }}
                        @if($paiement['statut'] === 'retard')
                            <span class="badge bg-danger">En retard</span>
                        @elseif($paiement['statut'] === 'aujourdhui')
                            <span class="badge bg-warning">Aujourd'hui</span>
                        @else
                            <span class="badge bg-success">À venir</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p class="text-center text-muted">Aucun paiement prévu pour ce mois.</p>
    @endif

</div>

<script>
    const paiements = @json($paiements);
    const monthNames = [
        'Janvier','Février','Mars','Avril','Mai','Juin',
        'Juillet','Août','Septembre','Octobre','Novembre','Décembre'
    ];

    let currentDate = new Date({{ $annee }}, {{ $mois - 1 }}, 1);

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        const filterValue = document.getElementById('filterTontine').value;

        let html = `
            <h4 class="text-center mb-3">${monthNames[month]} ${year}</h4>
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Lun</th><th>Mar</th><th>Mer</th><th>Jeu</th>
                        <th>Ven</th><th>Sam</th><th>Dim</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
        `;

        let dayCounter = 1;
        let dayOfWeek = (firstDay + 6) % 7;

        for (let i = 0; i < dayOfWeek; i++) {
            html += '<td></td>';
        }

        while (dayCounter <= daysInMonth) {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(dayCounter).padStart(2, '0')}`;

            const paiement = paiements.find(p =>
                p.date === dateStr && (filterValue === 'all' || p.tontine_nom === filterValue)
            );

            html += `<td style="height: 80px; vertical-align: middle; ${paiement ? 'background:' + paiement.color + '; color: white; font-weight:bold;' : ''}">
                ${dayCounter}
                ${paiement ? `<div style="font-size:0.75rem;">${paiement.tontine_nom}</div>` : ''}
            </td>`;

            dayCounter++;
            dayOfWeek++;

            if (dayOfWeek === 7 && dayCounter <= daysInMonth) {
                html += '</tr><tr>';
                dayOfWeek = 0;
            }
        }

        if (dayOfWeek !== 7) {
            for (let i = dayOfWeek; i < 7; i++) {
                html += '<td></td>';
            }
        }

        html += '</tr></tbody></table>';

        document.getElementById('calendar').innerHTML = html;
    }

    document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    document.getElementById('filterTontine').addEventListener('change', renderCalendar);

    renderCalendar();
</script>
@endsection
