@extends('layouts.dashboard.main')

@section('title')
Modification les infos de stagiaire
@endsection

@section('content')
<div class="container mt-2 mb-5 min-vh-100">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-1">
                <div class="card-header bg-dark text-light fs-4">Modification les infos de stagiaire #{{ $stg->id }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.stg.update', $stg->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="cin" class="col-md-4 col-form-label text-md-end">{{ __('CIN') }}</label>

                            <div class="col-md-6">
                                <input id="cin" type="text" class="form-control" disabled name="cin"
                                    value="{{ $stg->cin }}" required autocomplete="cin" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nom" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror"
                                    name="nom" value="{{ $stg->nom }}" required autocomplete="nom" autofocus>

                                @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="prenom" class="col-md-4 col-form-label text-md-end">{{ __('Prénom') }}</label>

                            <div class="col-md-6">
                                <input id="prenom" type="text"
                                    class="form-control @error('prenom') is-invalid @enderror" name="prenom"
                                    value="{{ $stg->prenom }}" required autocomplete="prenom" autofocus>

                                @error('prenom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $stg->email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dateN" class="col-md-4 col-form-label text-md-end">{{ __('Date de naissance')
                                }}</label>

                            <div class="col-md-6">
                                <input id="dateN" type="date" class="form-control @error('dateN') is-invalid @enderror"
                                    name="dateN" value="{{ $stg->dateN }}" required autocomplete="dateN" autofocus>

                                @error('dateN')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telephone" class="col-md-4 col-form-label text-md-end">{{ __('Téléphone')
                                }}</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text"
                                    class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                    value="{{ $stg->telephone }}" required autocomplete="telephone" autofocus>

                                @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="adresse" class="col-md-4 col-form-label text-md-end">{{ __('Adresse') }}</label>

                            <div class="col-md-6">
                                <textarea id="adresse" type="text"
                                    class="form-control @error('adresse') is-invalid @enderror" name="adresse" required
                                    autocomplete="adresse" autofocus>{{ $stg->adresse }}</textarea>

                                @error('adresse')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sexe" class="col-md-4 col-form-label text-md-end">{{ __('Sexe') }}</label>

                            <div class="col-md-6">
                                <select id="sexe" name="sexe" class="form-select" aria-label="Default select example">
                                    <option value="" disabled></option>
                                    <option {{ $stg->sexe == 'm'? 'selected': '' }} value="m">M</option>
                                    <option {{ $stg->sexe == 'f'? 'selected': '' }} value="f">F</option>
                                </select>
                            </div>

                            @error('sexe')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>

                <div class="row mb-3">
                    <label for="etablissement" class="col-md-4 col-form-label text-md-end">{{ __('Etablissement')
                        }}</label>

                    <div class="col-md-6">
                        <input id="etablissement" type="text"
                            class="form-control @error('etablissement') is-invalid @enderror" name="etablissement"
                            value="{{ $stg->etablissement }}" required autocomplete="etablissement" autofocus>

                        @error('etablissement')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="filiere" class="col-md-4 col-form-label text-md-end">{{ __('Filière') }}</label>
                    <div class="col-md-6">
                        <input id="filiere" type="text" class="form-control @error('filiere') is-invalid @enderror"
                            name="filiere" value="{{ $stg->filiere }}" required autocomplete="filiere" autofocus>

                        @error('filiere')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="niveau" class="col-md-4 col-form-label text-md-end">{{ __('Formation professionelle')
                        }}</label>

                    <div class="col-md-6">
                        <select id="niveau" name="niveau" class="form-select" aria-label="Default select example">
                            <option value="" disabled></option>
                            <option {{ $stg->niveau == 'bac+1'? 'selected': '' }} value="bac+1">Bac + 1</option>
                            <option {{ $stg->niveau == 'bac+2'? 'selected': '' }} value="bac+2">Bac + 2</option>
                            <option {{ $stg->niveau == 'bac+3'? 'selected': '' }} value="bac+3">Bac + 3</option>
                            <option {{ $stg->niveau == 'bac+4'? 'selected': '' }} value="bac+4">Bac + 4</option>
                            <option {{ $stg->niveau == 'bac+5'? 'selected': '' }} value="bac+5">Bac + 5</option>
                        </select>
                    </div>

                    @error('niveau')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <label for="cv" class="col-md-4 col-form-label text-md-end">{{ __('C.V') }}</label>
                    <div class="col-md-6">
                        <input id="cv" type="file" class="form-control @error('cv') is-invalid @enderror" name="cv"
                            value="{{ $stg->cv }}" autocomplete="cv" autofocus>

                        @error('cv')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-dark mb-2">
                            {{ __('Modifier') }}
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
