@extends('layouts.dashboard.main')
@section('title')
Offres
@endsection

@section('content')
<div class="container">
    <div class="card m-5">
        <div class="card-header bg-dark text-center">
            <h3 class="text-bg-dark fw-bold">Offre #{{ $offre->id }}</h3>
        </div>
        <div class="card-body">
            <table class="mb-4">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-3">
                            <strong class="fs-5 badge bg-dark mt-0">Sujet: </strong>
                        </td>
                        <td>
                            <h3 class="card-title">{{ Str::upper($offre->sujet) }}</h3>
                            <hr class="m-0">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">
                            <strong class="fs-5 badge bg-dark me-3">Type: </strong>
                        </td>
                        <td>
                            <h3 class="card-title">{{ Str::ucfirst($offre->type) }}</h3>
                            <hr class="m-0">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">
                            <strong class="fs-5 badge text-bg-dark me-3">Date début: </strong>
                        </td>
                        <td>
                            <h3 class="card-title">{{ \Carbon\Carbon::parse($offre->date_debut)->format('d/m/Y') }}</h3>
                            <hr class="m-0">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">
                            <strong class="fs-5 badge bg-dark me-3">Durée: </strong>
                        </td>
                        <td class="w-100">
                            <h3 class="card-title">{{ $offre->duree >= 30? Str::of($offre->duree/30).' mois' : Str::of($offre->duree) .' jours' }}</h3>
                            <hr class="m-0">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong class="fs-5 badge bg-dark me-3">Lieu: </strong>
                        </td>
                        <td class="py-3">
                            <h3 class="card-title">{{ Str::ucfirst($offre->lieu) }}</h3>
                            <hr class="m-0">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">
                            <strong class="fs-5 badge bg-dark me-3">Description: </strong>
                        </td>
                        <td>
                            <h3 class="card-title">{{ Str::ucfirst($offre->description) }}</h3>
                            <hr class="m-0">
                        </td>
                    </tr>
                </tbody>
            </table>

            <a href="{{ route('admin.offres') }}" class="btn btn-dark my-2 fw-bold">RETOUR AU LIST DES OFFRES</a>
        </div>
    </div>
</div>

@endsection
