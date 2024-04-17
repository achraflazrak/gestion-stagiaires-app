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
                <th scope="col">C.V de stagiaire</th>
                <th scope="col">Lettre de motivation</th>
                <th scope="col">Fiche de confirmation</th>
                <th scope="col">Fiche d'évaluation</th>
                <th scope="col">Rapport de stage</th>
                <th scope="col">Attestation</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 0; @endphp
            @foreach ($stgs as $key => $stg)
                @foreach ($stg->demandes as $demande)
                <tr>
                    <td>{{ ++$counter }}</td>
                    <td>{{ Str::ucfirst($stg->nom) }} {{ Str::ucfirst($stg->prenom) }}</td>
                    <td>{{ Str::upper($stg->cin) }}</td>
                    <td>#{{ $demande->offre->id }}</td>
                    <td>{{ Str::ucfirst($demande->offre->sujet) }}</td>
                    <td>
                        <a href="{{ route('admin.document.cv.pdf', basename($stg->cv, '.pdf')) }}" class="btn btn-primary"><i
                                class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.document.cv', $demande->id) }}" class="btn btn-success">
                            <i class="fas fa-download"></i>

                    </td>
                    <td>
                        <a href="{{ route('admin.document.lm.pdf', basename($demande->lettre_motivation, '.pdf')) }}" class="btn btn-primary"><i
                                class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.document.lm', $demande->id) }}" class="btn btn-success">
                            <i class="fas fa-download"></i>
                    </td>

                    @php $stage = $demande->offre->findStageByStgAndOffre($stg, $demande->offre) @endphp
                    @if($stage)
                        <td>
                            @if($stage->fiche_confirmation)
                                <a href="{{ route('admin.document.fc.pdf', basename($stage->fiche_confirmation, '.pdf')) }}" class="btn btn-primary"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.document.fc', $stage->id) }}" class="btn btn-success">
                                        <i class="fas fa-download"></i>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td>
                            @if($stage->fiche_evaluation)
                                <a href="{{ route('admin.document.fe.pdf', basename($stage->fiche_evaluation, '.pdf')) }}" class="btn btn-primary"><i
                                    class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.document.fe', $stage->id) }}" class="btn btn-success">
                                    <i class="fas fa-download"></i>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td>
                            @if($stage->rapport)
                                <a href="{{ route('admin.document.rap.pdf', basename($stage->rapport, '.pdf')) }}" class="btn btn-primary"><i
                                    class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.document.rap', $stage->id) }}" class="btn btn-success">
                                    <i class="fas fa-download"></i>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.document.att', $stage->id) }}" class="btn btn-{{ $stage->statut != 1? 'dark disabled' : 'success' }}">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                    @else
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    @endif
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

@endsection
