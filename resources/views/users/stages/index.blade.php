@extends('layouts.users.main')
@section('title')
Stages
@endsection

@section('content')
<div class="container">
    @if(Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
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
                <td>{{ \Carbon\Carbon::parse($stage->offre->date_debut)->addDays($stage->offre->duree)->format('d/m/Y')
                    }}</td>
                <td>
                    <span
                        class="badge p-2 text-bg-{{ $stage->statut == -1? 'info' : ( $stage->statut == -2? 'danger' : ($stage->statut? 'success': 'primary')) }}">
                        {{ $stage->statut == -1? 'préstage' : ( $stage->statut == -2? 'Expiré' : ($stage->statut? 'stage
                        terminé' : 'stage en cours' ) ) }}
                    </span>
                </td>
                <td>
                    @if($stage->fiche_confirmation)
                    <a href="{{ route('user.stage.fc.pdf', basename($stage->fiche_confirmation, '.pdf')) }}" target="_blank"
                        class="btn btn-primary"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('user.stage.fc', $stage->id) }}" class="btn btn-success }}" target="_blank">
                        <i class="fas fa-download"></i></a>

                            <form action="{{ route('user.stage.delete.fc', $stage->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-danger mt-1" onclick="return confirm('Ëtes vous sûre de supprimer cette fiche de confirmation?')" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        @else
                        <span>
                            <form action="{{ route('user.stage.update.fc', $stage->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="file" name="fiche_confirmation" class="@error('fiche_confirmation') is-invalid @enderror">
                                @error('fiche_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <button class="btn btn-primary mt-1" type="submit">Envoyer</button>
                            </form>
                        </span>
                        @endif

                </td>
                <td>
                    @if($stage->fiche_evaluation)
                    <a href="{{ route('user.stage.fe.pdf', basename($stage->fiche_evaluation, '.pdf')) }}" target="_blank"
                        class="btn btn-primary"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('user.stage.fe', $stage->id) }}" class="btn btn-success }}" target="_blank">
                        <i class="fas fa-download"></i></a>
                        <form action="{{ route('user.stage.delete.fe', $stage->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger mt-1" onclick="return confirm('Ëtes vous sûre de supprimer cette fiche d\'évaluation?')" type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    @else
                        <span>
                            <form action="{{ route('user.stage.update.fe', $stage->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="file" name="fiche_evaluation" class="@error('fiche_evaluation') is-invalid @enderror">
                                @error('fiche_evaluation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <button class="btn btn-primary mt-1" type="submit">Envoyer</button>
                            </form>
                        </span>
                    @endif
                </td>
                <td>
                    @if($stage->rapport)
                        <a href="{{ route('user.stage.rap.pdf', basename($stage->rapport, '.pdf')) }}" target="_blank"
                            class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('user.stage.rap', $stage->id) }}" class="btn btn-success }}">
                            <i class="fas fa-download"></i></a>
                            <form action="{{ route('user.stage.delete.rap', $stage->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-danger mt-1" onclick="return confirm('Ëtes vous sûre de supprimer ce rapport?')" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        @else
                            <span>
                                <form action="{{ route('user.stage.update.rap', $stage->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="rapport" class="@error('rapport') is-invalid @enderror" required>
                                    @error('rapport')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <button class="btn btn-primary mt-1" type="submit">Envoyer</button>
                                </form>
                            </span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('user.stage.att', $stage->id) }}" target="_blank"
                        class="btn btn-{{ $stage->statut != 1? 'dark disabled' : 'success' }}">
                        <i class="fas fa-download"></i>
                    </a>
                </td>
                <td>
                    <form action="{{ route('user.stage.destroy', $stage->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Est ce que tu es sûre de supprimer ce stage?')">
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
