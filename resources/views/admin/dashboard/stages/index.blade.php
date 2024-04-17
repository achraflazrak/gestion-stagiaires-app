@extends('layouts.dashboard.main')
@section('title')
Stages
@endsection

@section('content')
<div class="container">
    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th scope="">#</th>
                <th scope="col">Nom & Prénom de Stagaire</th>
                <th scope="col">CIN de stagiaire</th>
                <th scope="col">Id de l'offre</th>
                <th scope="col">Sujet de l'offre</th>
                <th scope="col">Date de début</th>
                <th scope="col">Date de fin</th>
                <th scope="col">Statut</th>
                <th scope="col">Fiche de confirmation</th>
                <th scope="col">Fiche d'évaluation</th>
                <th scope="col" class="px-4">Rapport de stage</th>
                <th scope="col">Télécharger Attestation</th>
                <th scope="col">Actions</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stages as $key => $stage)
            <tr>
                <th>{{ $stage->id }}</th>
                <td>{{ Str::ucfirst($stage->user->nom) }} {{ Str::ucfirst($stage->user->prenom) }}</td>
                <td>{{ Str::upper($stage->user->cin) }}</td>
                <td>#{{ $stage->offre->id }}</td>
                <td>{{ $stage->offre->sujet }}</td>
                <td>{{ \Carbon\Carbon::parse($stage->offre->date_debut)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($stage->offre->date_debut)->addDays($stage->offre->duree)->format('d/m/Y') }}</td>
                <td>
                    <span
                        class="badge p-2 text-bg-{{ $stage->statut == -1? 'info' : ( $stage->statut == -2? 'danger' : ($stage->statut? 'success': 'primary')) }}">
                        {{ $stage->statut == -1? 'préstage' : ( $stage->statut == -2? 'Expiré' : ($stage->statut? 'stage terminé' : 'stage en cours' ) ) }}
                    </span>
                </td>
                <td>
                    @if($stage->fiche_confirmation)
                        <a href="{{ route('admin.stage.fc.pdf', basename($stage->fiche_confirmation, '.pdf')) }}" class="btn btn-primary"><i
                                class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.stage.fc', $stage->id) }}" class="btn btn-success }}">
                            <i class="fas fa-download"></i>
                    @else
                        <span>-</span>
                    @endif

                </td>
                <td>
                    @if($stage->fiche_evaluation)
                        <a href="{{ route('admin.stage.fe.pdf', basename($stage->fiche_evaluation, '.pdf')) }}" class="btn btn-primary"><i
                            class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.stage.fe', $stage->id) }}" class="btn btn-success }}">
                            <i class="fas fa-download"></i>
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>
                   @if($stage->rapport)
                        <a href="{{ route('admin.stage.rap.pdf', basename($stage->rapport, '.pdf')) }}" class="btn btn-primary"><i
                                class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.stage.rap', $stage->id) }}" class="btn btn-success }}">
                            <i class="fas fa-download"></i>
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.stage.att', $stage->id) }}" class="btn btn-{{ $stage->statut != 1? 'dark disabled' : 'success' }}">
                        <i class="fas fa-download"></i>
                    </a>
                </td>
                <td>
                    <form action="{{ route('admin.stage.statut.prestage', $stage->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-secondary m-2">Préstage</button>
                    </form>

                    <form action="{{ route('admin.stage.statut.encours', $stage->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary m-2">Encours</button>
                    </form>

                    <form action="{{ route('admin.stage.statut.finstage', $stage->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success m-2">Fin de stage</button>
                    </form>
                    <form action="{{ route('admin.stage.statut.annuler', $stage->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger m-2">Annuler</button>
                    </form>

                </td>
                <td>

                    <form action="{{ route('admin.stage.destroy', $stage->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Est ce que tu es sûre de supprimer ce stage?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
