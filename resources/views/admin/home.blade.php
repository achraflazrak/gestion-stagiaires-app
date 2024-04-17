@extends('layouts.dashboard.main')

@section('title')
Dashboard
@endsection

@section('content')
    <div class="ms-5">
        <h2 class="d-inline-block text-bg-dark p-2 rounded-2">Offres: </h2>
        <div class="row justify-content-around text-center mb-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-bg-primary fw-bold p-4">{{ __('Offres de stage') }}</div>

                        <div class="card-body p-4">
                            {{ $nbOffres }}
                        </div>
                    </div>
                </div>

                 <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-bg-primary fw-bold p-4">{{ __('Offres Publiées') }}</div>

                        <div class="card-body p-4">
                            {{ $nbOffresPubliees }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-bg-primary fw-bold p-4">{{ __('Stagiaires') }}</div>

                        <div class="card-body p-4">
                            {{ $nbStgs }}
                        </div>
                    </div>
                </div>

            </div>

            <h2 class="d-inline-block text-bg-dark p-2 rounded-2">Demandes:</h2>
            <div class="row justify-content-around text-center mt-2">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header text-light bg-dark fw-bold p-4">{{ __('Demandes de stages') }}</div>

                        <div class="card-body p-4">
                            {{ $nbDemandes }}
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header text-light bg-dark fw-bold p-4">{{ __('Demandes en attendes') }}</div>

                        <div class="card-body p-4">
                            {{ $nbDemandesAttendes }}
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header text-bg-danger fw-bold p-4">{{ __('Demandes de stages refusées') }}</div>

                        <div class="card-body p-4">
                            {{ $nbDemandesRefusees }}
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card">
                        <div class="card-header text-bg-success fw-bold p-4">{{ __('Demandes de stages acceptées') }}</div>

                        <div class="card-body p-4">
                            {{ $nbDemandesAcceptees }}
                        </div>
                    </div>
                </div>

            </div>

            <h2 class="d-inline-block text-bg-dark p-2 rounded-2">Stages:</h2>
            <div class="row justify-content-around text-center mt-1">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-bg-primary fw-bold p-4">{{ __('Stages') }}</div>

                        <div class="card-body p-4">
                            {{ $nbStages }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-light bg-dark fw-bold p-4">{{ __('Stages en cours') }}</div>

                        <div class="card-body p-4">
                            {{ $nbStagesEnCours }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-bg-success fw-bold p-4">{{ __('Stages Terminé') }}</div>

                        <div class="card-body p-4">
                            {{ $nbStagesTermines }}
                        </div>
                    </div>
                </div>
            </div>
    </div>


@endsection
