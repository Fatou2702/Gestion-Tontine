@extends('layout.user') {{-- Ou ton layout --}}

@section('content')
    <h2>Rejoindre une Tontine</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Montant</th>
                <th>Participants</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($tontines as $tontine)
                <tr>
                    <td>{{ $tontine->name }}</td>
                    <td>{{ number_format($tontine->montant, 0, ',', ' ') }} CFA</td>
                    <td>{{ $tontine->users_count }}</td>
                    <td>
                        <form action="{{ route('tontines.join', $tontine->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Rejoindre</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
