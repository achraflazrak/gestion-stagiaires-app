@extends('layouts.dashboard.main')
@section('title')
 Infos Stagiaire
@endsection

@section('content')
<div class="container">
    @if(session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <div class="card">
        <div class="card-header bg-dark text-center">
            <h3 class="text-bg-dark fw-bold">Stagiaire {{ $stg->sexe == 'm'? 'M' : 'Mme' }} {{ Str::ucfirst($stg->nom)
                }}
                {{ Str::ucfirst($stg->prenom) }}</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title"><strong>CIN: </strong>{{ Str::upper($stg->cin) }}</h5>
            <h5 class="card-title"><strong>E-mail: </strong>{{ $stg->email }}</h5>
            <h5 class="card-title"><strong>Date de naissance: </strong>{{
                \Carbon\Carbon::parse($stg->dateN)->format('d/m/Y') }}</h5>
            <h5 class="card-title"><strong>Téléphone: </strong>{{ $stg->telephone }}</h5>
            <h5 class="card-title"><strong>Adresse: </strong>{{ Str::ucfirst($stg->adresse) }}</h5>
            <h5 class="card-title"><strong>Sexe: </strong>{{ Str::upper($stg->sexe) }}</h5>
            <h5 class="card-title"><strong>Etablissement: </strong>{{ Str::ucfirst($stg->etablissement) }}</h5>
            <h5 class="card-title"><strong>Filière: </strong>{{ Str::ucfirst($stg->filiere) }}</h5>
            <h5 class="card-title"><strong>Formation professionelle: </strong>{{ Str::ucfirst($stg->niveau) }}</h5>

            <h5 class="card-title d-flex flex-column">
                <strong>C.V: </strong>
                <div class="mx-5">
                    <a href="{{ route('admin.demande.cv.pdf', basename($stg->cv, '.pdf')) }}" target="_blank"
                        class="btn btn-success"><i class="fas fa-eye"></i></a>
                </div>
            </h5>

            @if($stg->demandes->count() != 0)
            <h5 class="card-title mt-3">
                <strong>Demandes:</strong>
            </h5>
            <div class="accordion mb-4" id="accordionPanelsStayOpenExample">
                @foreach ($stg->demandes as $key => $demande)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne{{ $key }}">
                        <button class="accordion-button text-bg-light border border-1 border-dark" type="button"
                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne{{ $key }}"
                            aria-expanded="true" aria-controls="panelsStayOpen-collapseOne{{ $key }}">
                            <strong>Demande #{{ $demande->id }}</strong>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne{{ $key }}" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingOne{{ $key }}">
                        <div class="accordion-body text-bg-light border border-1 border-dark">
                            <h5 class="card-title"><strong>Sujet: </strong>{{ $demande->offre->sujet }}</h5>
                            <h5 class="card-title d-flex flex-column">
                                <h5 class="card-title"><strong>Lettre de motivation</strong></h5>
                                <div class="mx-5">
                                    <a href="{{ route('admin.demande.lm.pdf', basename($demande->lettre_motivation, '.pdf')) }}"
                                        target="_blank" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </h5>
                            <h5 class="card-title mt-3"><strong>Statut: </strong>
                                <span
                                    class="badge p-2 mb-2 text-bg-{{ $demande->is_accept === null? 'primary' : ($demande->is_accept? 'success' : 'danger') }}">
                                    {{ $demande->is_accept === null? 'En cours de validation' : ($demande->is_accept?
                                    'Accepter' : 'Refadmin') }}
                                </span>
                            </h5>
                            @if ($demande->is_accept && $demande->getStageByDemandeId($demande->id))
                            <div class="accordion" id="accordionExampleS{{ $key }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOneS{{ $key }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOneS{{ $key }}" aria-expanded="true"
                                            aria-controls="collapseOneS{{ $key }}">
                                            <strong>Stage #{{ $demande->getStageByDemandeId($demande->id)->id }}</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOneS{{ $key }}"
                                        data-bs-parent="#accordionExampleS{{ $key }}">
                                        <div class="accordion-body">
                                            <h5 class="card-title mt-3">
                                                <strong>Statut: </strong>
                                                <span
                                                    class="badge p-2 text-bg-{{ $demande->getStageByDemandeId($demande->id)->statut == -1? 'info' : ( $demande->getStageByDemandeId($demande->id)->statut == -2? 'danger' : ($demande->getStageByDemandeId($demande->id)->statut? 'success': 'primary')) }}">
                                                    {{ $demande->getStageByDemandeId($demande->id)->statut == -1?
                                                    'préstage' : (
                                                    $demande->getStageByDemandeId($demande->id)->statut == -2? 'Expiré'
                                                    :
                                                    ($demande->getStageByDemandeId($demande->id)->statut? 'stage
                                                    terminé' : 'stage en cours' ) ) }}
                                                </span>
                                            </h5>

                                            @if ($demande->getStageByDemandeId($demande->id)->fiche_confirmation)
                                            <h5 class="card-title d-flex flex-column">
                                                <strong> Fiche de confirmation </strong>
                                                <div class="mx-5">
                                                    <a href="{{ route("admin.stage.fc.pdf",
                                                        basename($demande->getStageByDemandeId($demande->id)->fiche_confirmation,
                                                        '.pdf')) }}"
                                                        target="_blank" class="btn btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </h5>
                                            @endif

                                            @if ($demande->getStageByDemandeId($demande->id)->fiche_evaluation)
                                            <h5 class="card-title d-flex flex-column">
                                                <strong> Fiche d'évaluation </strong>
                                                <div class="mx-5">
                                                    <a href="{{ route("admin.stage.fe.pdf",
                                                        basename($demande->getStageByDemandeId($demande->id)->fiche_evaluation,
                                                        '.pdf')) }}"
                                                        target="_blank" class="btn btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </h5>
                                            @endif

                                            @if ($demande->getStageByDemandeId($demande->id)->rapport)
                                            <h5 class="card-title d-flex flex-column">
                                                <strong> Rapport </strong>
                                                <div class="mx-5">
                                                    <a href="{{ route("admin.stage.rap.pdf",
                                                        basename($demande->getStageByDemandeId($demande->id)->rapport,
                                                        '.pdf')) }}"
                                                        target="_blank" class="btn btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </h5>
                                            @endif

                                            @if ($demande->getStageByDemandeId($demande->id)->statut == 1)
                                            <h5 class="card-title d-flex flex-column">
                                                <strong>Attestation</strong>
                                                <div class="mx-5">
                                                    <a href="{{ route('admin.stage.att', $demande->getStageByDemandeId($demande->id)->id) }}"
                                                        target="_blank"
                                                        class="btn btn-{{ $demande->getStageByDemandeId($demande->id)->statut != 1 ? 'dark disabled' : 'success' }}">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>
                                            </h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @endif

            <a href="{{ route('admin.home') }}" class="btn btn-dark my-3 fw-bold mx-2">RETOUR A LA PAGE PRECEDENTE</a>
            <a href="{{ route('admin.stg.edit', $stg->id) }}" class="btn btn-primary"><i class="fas fa-pencil"></i> </a>

        </div>
    </div>
</div>

@endsection
