<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <label for="cin" class="col-md-4 col-form-label text-md-end">{{ __('CIN') }}</label>

        <div class="col-md-6">
            <input id="cin" type="text" class="form-control @error('cin') is-invalid @enderror" name="cin"
                value="{{ old('cin') }}" required autocomplete="cin" autofocus>

            @error('cin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="nom" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>

        <div class="col-md-6">
            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                value="{{ old('nom') }}" required autocomplete="nom" autofocus>

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
            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom"
                value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>

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
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmez le mot de passe') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>
    </div>

    <div class="row mb-3">
        <label for="dateN" class="col-md-4 col-form-label text-md-end">{{ __('Date de naissance') }}</label>

        <div class="col-md-6">
            <input id="dateN" type="date" class="form-control @error('dateN') is-invalid @enderror" name="dateN"
                value="{{ old('dateN') }}" required autocomplete="dateN" autofocus>

            @error('dateN')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="telephone" class="col-md-4 col-form-label text-md-end">{{ __('Téléphone') }}</label>

        <div class="col-md-6">
            <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                value="{{ old('telephone') }}" required autocomplete="telephone" autofocus>

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
                <textarea id="adresse" type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse"
                     required autocomplete="adresse" autofocus>{{ old('adresse') }}</textarea>

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
            <select id="sexe" name="sexe" class="form-select @error('sexe') is-invalid @enderror"
                aria-label="Default select example">
                <option value="" disabled {{ old('sexe') ? '' : 'selected' }}>Choisir un option...</option>
                <option value="m" {{ old('sexe')=='m' ? 'selected' : '' }}>M</option>
                <option value="f" {{ old('sexe')=='f' ? 'selected' : '' }}>F</option>
            </select>

            @error('sexe')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="etablissement" class="col-md-4 col-form-label text-md-end">{{ __('Etablissement') }}</label>

        <div class="col-md-6">
            <input id="etablissement" type="text" class="form-control @error('etablissement') is-invalid @enderror"
                name="etablissement" value="{{ old('etablissement') }}" required autocomplete="etablissement" autofocus>

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
             <input id="filiere" type="text" class="form-control @error('filiere') is-invalid @enderror" name="filiere"
                value="{{ old('filiere') }}" required autocomplete="filiere" autofocus>

            @error('filiere')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

<div class="row mb-3">
    <label for="niveau" class="col-md-4 col-form-label text-md-end">{{ __('Formation professionelle') }}</label>

    <div class="col-md-6">
        <select id="niveau" name="niveau" class="form-select @error('niveau') is-invalid @enderror"
            aria-label="Default select example">
            <option value="" disabled {{ old('niveau') ? '' : 'selected' }}>Choisir un option...</option>
            <option value="bac+1" {{ old('niveau')=='bac+1' ? 'selected' : '' }}>Bac + 1</option>
            <option value="bac+2" {{ old('niveau')=='bac+2' ? 'selected' : '' }}>Bac + 2</option>
            <option value="bac+3" {{ old('niveau')=='bac+3' ? 'selected' : '' }}>Bac + 3</option>
            <option value="bac+4" {{ old('niveau')=='bac+4' ? 'selected' : '' }}>Bac + 4</option>
            <option value="bac+5" {{ old('niveau')=='bac+5' ? 'selected' : '' }}>Bac + 5</option>
        </select>

        @error('niveau')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

    <div class="row mb-3">
        <label for="cv" class="col-md-4 col-form-label text-md-end">{{ __('C.V') }}</label>
        <div class="col-md-6">
            <input id="cv" type="file" class="form-control @error('cv') is-invalid @enderror" name="cv" required
                autocomplete="off" autofocus>

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
                {{ __('S\'inscrire') }}
            </button>
        </div>
    </div>
</form>
