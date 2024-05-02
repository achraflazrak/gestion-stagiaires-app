{{-- resources/views/stages/create.blade.php --}}
@extends('layouts.dashboard.main')

@section('title')
    Creation de Stage
@endsection

@section('content')

<div class="container">
    <h1 class="fs-1 text-bg-dark text-center mb-5 p-2 rounded-2 fw-bold">Création de stage</h1>

    <form action="{{ route('admin.stage.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- User select --}}
        <div class="row mb-3">
            <label for="user_id" class="col-md-4 col-form-label text-md-end">{{ __('Stagiaires') }}</label>

            <div class="col-md-6">
                <select id="user_id" name="user_id" class="form-select @error('user_id') is-invalid @enderror"
                    aria-label="Default select example">
                    <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>Choisir un stagiaire...</option>
                    @foreach ($stgs as $stg)
                        <option value='{{ $stg->id }}' {{ old('user_id') == $stg->id ? 'selected' : '' }}>#{{ $stg->id }} {{ Str::ucfirst($stg->nom) }} {{ Str::ucfirst($stg->prenom) }}</option>
                    @endforeach
                </select>

                @error('user_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- offres select --}}
        <div class="row mb-3">
            <label for="offre_id" class="col-md-4 col-form-label text-md-end">{{ __('Offres') }}</label>

            <div class="col-md-6">
                <select id="offre_id" name="offre_id" class="form-select @error('offre_id') is-invalid @enderror"
                    aria-label="Default select example">
                    <option value="" disabled {{ old('offre_id') ? '' : 'selected' }}>Choisir une offre...</option>
                    @foreach ($offres as $offre)
                    <option value='{{ $offre->id }}' {{ old('offre_id') == $stg->id ? 'selected' : '' }}>#{{ $offre->id }} {{ Str::ucfirst($offre->sujet) }}</option>
                    @endforeach
                </select>

                @error('offre_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- Fiche Confirmation Upload --}}
        <div class="row mb-3">
            <label for="fiche_confirmation" class="col-md-4 col-form-label text-md-end">Fiche de Confirmation:</label>
            <div class="col-md-6">
                <input type="file" class="form-control" name="fiche_confirmation" id="fiche_confirmation" required @error('fiche_confirmation') is-invalid @enderror>
                @error('fiche_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- Fiche Evaluation Upload --}}
        <div class="row mb-3">
            <label for="fiche_evaluation" class="col-md-4 col-form-label text-md-end">Fiche d'Évaluation:</label>
            <div class="col-md-6">
                <input type="file" class="form-control" name="fiche_evaluation" id="fiche_evaluation" required @error('fiche_evaluation') is-invalid @enderror>
                @error('fiche_evaluation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- Rapport Upload --}}
        <div class="row mb-3">
            <label for="rapport" class="col-md-4 col-form-label text-md-end">Rapport:</label>
            <div class="col-md-6">
                <input type="file" class="form-control" name="rapport" id="rapport" required @error('rapport') is-invalid @enderror>
                @error('rapport')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4"></div>
            <button type="submit" class="btn btn-dark col-2 py-2 mt-4 fw-bold">Créer un stage</button>
        </div>
    </form>
</div>
@endsection
