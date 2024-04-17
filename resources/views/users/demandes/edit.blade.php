@extends('layouts.users.main')

@section('title')
Modification une demande
@endsection

@section('content')

<div class="me-5">
    <h1 class="text-center">Modifier une demande</h1>
    <form method="POST"
        action="{{ route('user.demande.update', $demande->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row mb-3 mt-4">
            <label for="lettre_motivation" class="col-md-4 col-form-label text-md-end">{{ __('Lettre motivation')
                }}</label>

            <div class="col-md-6">
                <input id="lettre_motivation" type="file"
                    class="form-control @error('lettre_motivation') is-invalid @enderror" name="lettre_motivation"
                    value="{{ $demande->lettre_motivation }}" required autocomplete="lettre_motivation" autofocus>

                @error('lettre_motivation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 mt-4">
            <label for="offre_id" class="col-md-4 col-form-label text-md-end">{{ __('Offres') }}</label>

            <div class="col-md-6">
                <select class="form-select @error('offre_id') is-invalid @enderror" name="offre_id"
                    value="{{ $demande->offre_id }}" required autocomplete="lettre_motivation" autofocus
                    aria-label="Default select example">
                    <option disabled>Choisir une offre</option>
                    <option selected value="{{ $demande->offre_id }}">{{ $demande->offre->sujet }}</option>
                    @foreach ($offres as $offre)
                        @if($offre->id != $demande->offre->id && !$offre->demandes->count())
                            <option value="{{ $offre->id }}">#{{ $offre->id }} {{ $offre->sujet }}</option>
                        @endif
                    @endforeach
                </select>

                @error('offre_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-dark mt-2">
                    {{ __('Modifier') }}
                </button>
            </div>
        </div>
    </form>
</div>

@endsection

</form>
