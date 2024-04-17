@extends('layouts.dashboard.main')
@section('title')
Stagiaires
@endsection

@section('content')
<div class="container">
    <div class="card m-5">
        <div class="card-header bg-dark text-center">
            <h3 class="text-bg-dark fw-bold">Stagiaire {{ $stg->sexe == 'm'? 'Mr' : 'M' }} {{ Str::ucfirst($stg->nom) }} {{ Str::ucfirst($stg->prenom) }}</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title"><strong>CIN: </strong>{{ Str::upper($stg->cin) }}</h5>
            <h5 class="card-title"><strong>E-mail: </strong>{{ $stg->email }}</h5>
            <h5 class="card-title"><strong>Date de naissance: </strong>{{ \Carbon\Carbon::parse($stg->dateN)->format('d/m/Y') }}</h5>
            <h5 class="card-title"><strong>Téléphone: </strong>{{ $stg->telephone }}</h5>
            <h5 class="card-title"><strong>Adresse: </strong>{{ Str::ucfirst($stg->adresse) }}</h5>
            <h5 class="card-title"><strong>Sexe: </strong>{{ Str::upper($stg->sexe) }}</h5>
            <h5 class="card-title"><strong>Etablissement: </strong>{{ Str::ucfirst($stg->etablissement) }}</h5>
            <h5 class="card-title"><strong>Filière: </strong>{{ Str::ucfirst($stg->filiere) }}</h5>
            <h5 class="card-title"><strong>Formation professionelle: </strong>{{ Str::ucfirst($stg->niveau) }}</h5>

            <h5 class="card-title d-flex flex-column">
                <strong>C.V: </strong>
                <div class="d-flex justify-content-center">
                    <embed src="{{ asset($stg->cv) }}" type="application/pdf" width="60%" height="300px" class="mt-2" />
                </div>
            </h5>

            @if($stg->demandes)
                <h5 class="card-title mt-4">
                    <strong>Nombre de stages: </strong>{{ $stg->stages->count() }}
                </h5>
                <h5 class="card-title mt-3">
                    <strong>Demandes:</strong>
                </h5>
                <div class="accordion mb-4" id="accordionPanelsStayOpenExample">
                    @foreach ($stg->demandes as $demande)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button text-bg-light border border-1 border-dark" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                <strong>Demande #{{ $demande->id }}</strong>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body text-bg-light border border-1 border-dark">
                                    <h5 class="card-title"><strong>Sujet: </strong>{{ $demande->offre->sujet }}</h5>
                                    <h5 class="card-title d-flex flex-column">
                                        <h5 class="card-title"><strong>Lettre de motivation</strong></h5>
                                        <div class="d-flex justify-content-center">
                                            <embed src="{{ asset($demande->lettre_motivation) }}" type="application/pdf" width="60%" height="300px" class="mt-2" />
                                        </div>
                                    </h5>
                                    <h5 class="card-title mt-3"><strong>Statut: </strong>
                                        <span class="badge p-2 mb-2 text-bg-{{ $demande->is_accept === null? 'primary' : ($demande->is_accept? 'success' : 'danger') }}">
                                            {{ $demande->is_accept === null? 'En cours de validation' : ($demande->is_accept? 'Accepter' : 'Refuser') }}
                                        </span>
                                     </h5>
                                </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            @endif

            <a href="{{ route('admin.stgs') }}" class="btn btn-dark my-3 fw-bold">RETOUR AU LIST DES STAGIAIRES</a>
        </div>
    </div>
</div>

@endsection
