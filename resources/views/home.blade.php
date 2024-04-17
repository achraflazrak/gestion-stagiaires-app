@extends('layouts.users.main')
@section('title')
My Infos
@endsection

@section('content')
<div class="container">
    <h1 class="text-center fw-bold text-bg-dark mx-5 p-4 rounded-4">Bienvenue {{ $stg->sexe == 'm'? 'Mr' : 'M' }} {{ Str::ucfirst($stg->nom) }} {{ Str::ucfirst($stg->prenom) }}</h1>

    <div class="row text-center m-5 d-flex justify-content-between">
        <div class="col-5 my-5">
            <div class="card">
                <div class="card-header text-bg-dark fs-3">Mes demandes</div>
                <div class="card-body fs-4">
                    {{ $stg->demandes->count() }}
                </div>
            </div>
        </div>

        <div class="col-5 my-5">
            <div class="card">
                <div class="card-header text-bg-dark fs-3">Mes stages</div>
                <div class="card-body fs-4">
                    {{ $stg->stages->count() }}
                </div>
            </div>
        </div>

    </div>

    <div class="d-flex justify-content-center">
        <a href="{{ route('users.offers.show') }}" class="btn btn-dark px-5 m-5 fw-bold fs-3">Afficher les Offres</a>
    </div>



</div>

@endsection
