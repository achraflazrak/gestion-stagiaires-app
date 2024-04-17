@extends('layouts.dashboard.main')
@section('title')
Modifier Offre
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-bg-dark fs-3 text-center">Modification d'un offre de stage</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.offre.update', $offre->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

                    <div class="col-md-6">
                        <input id="type" type="text" class="form-control @error('type') is-invalid @enderror"
                            name="type" value="{{ $offre->type }}" required autocomplete="type" autofocus>

                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sujet" class="col-md-4 col-form-label text-md-end">{{ __('Sujet') }}</label>

                    <div class="col-md-6">
                        <input id="sujet" type="text" class="form-control @error('sujet') is-invalid @enderror"
                            name="sujet" value="{{ $offre->sujet }}" required autocomplete="sujet" autofocus>

                        @error('sujet')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="profil_requis" class="col-md-4 col-form-label text-md-end">{{ __('Profil requis')
                        }}</label>

                    <div class="col-md-6">
                        <textarea id="profil_requis" type="text"
                            class="form-control @error('profil_requis') is-invalid @enderror" name="profil_requis"
                            required autocomplete="profil_requis" autofocus>{{ $offre->profil_requis }}</textarea>

                        @error('profil_requis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="date_debut" class="col-md-4 col-form-label text-md-end">{{ __('Date début') }}</label>

                    <div class="col-md-6">
                        <input id="date_debut" type="date" class="form-control @error('date_debut') is-invalid @enderror"
                            name="date_debut" value="{{ $offre->date_debut }}" required autocomplete="date_debut">

                        @error('date_debut')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="duree" class="col-md-4 col-form-label text-md-end">{{ __('Durée') }}</label>

                    <div class="col-md-6">
                        <input id="duree" type="number" class="form-control @error('duree') is-invalid @enderror"
                            name="duree" value="{{ $offre->duree }}" required autocomplete="duree">

                        @error('duree')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="lieu" class="col-md-4 col-form-label text-md-end">{{ __('Lieu') }}</label>

                    <div class="col-md-6">
                        <input id="lieu" type="text" class="form-control @error('lieu') is-invalid @enderror"
                            name="lieu" value="{{ $offre->lieu }}" required autocomplete="lieu">

                        @error('lieu')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                    <div class="col-md-6">
                        <textarea id="description" type="text"
                            class="form-control @error('description') is-invalid @enderror" name="description" required
                            autocomplete="description" autofocus>{{ $offre->description }}</textarea>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-dark mb-2">
                            {{ __('Modifier un offre') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
