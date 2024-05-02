@extends('layouts.dashboard.main')
@section('title')
Demandes
@endsection

@section('content')
<div class="container">
    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom & Prénom de Stagaire</th>
                <th scope="col">CIN de stagiaire</th>
                <th scope="col">Id de l'offre de stage</th>
                <th scope="col">Sujet de l'offre de stage</th>
                <th scope="col">C.V de stagiaire</th>
                <th scope="col">Lettre de motivation</th>
                <th scope="col">Statut</th>
                <th scope="col">Actions</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($demandes as $key => $demande)
                <tr>
                    <th scope="row">{{ $demande->id }}</th>
                    <td>{{ Str::ucfirst($demande->user->nom) }} {{ Str::ucfirst($demande->user->prenom) }}</td>
                    <td>{{ Str::upper($demande->user->cin) }}</td>
                    <td>#{{ $demande->offre->id }}</td>
                    <td>{{ Str::ucfirst($demande->offre->sujet) }}</td>
                    <td>
                        <a href="{{ route('admin.demande.cv.pdf', basename($demande->user->cv, '.pdf')) }}" class="btn btn-primary my-2" target="_blank"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.demande.cv', $demande->id) }}" class="btn btn-success" target="_blank">
                            <i class="fas fa-download"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.demande.lm.pdf', basename($demande->lettre_motivation, '.pdf')) }}" class="btn btn-primary my-2" target="_blank"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.demande.lm', $demande->id) }}" class="btn btn-success" target="_blank">
                            <i class="fas fa-download"></i>
                        </a>
                    </td>
                    <td>
                        <span class="badge p-2 text-bg-{{ $demande->is_accept === null? 'primary' : ($demande->is_accept? 'success': 'danger') }}">
                            {{ $demande->is_accept === null? 'En cours de validation' : ($demande->is_accept? 'Accepter' : 'Refuser') }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.demande.accepter', $demande->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success m-2">Accepter</button>
                        </form>

                        <form action="{{ route('admin.demande.refuser', $demande->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger m-2">Refuser</button>
                        </form>

                        <form action="{{ route('admin.demande.encours', $demande->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary m-2">Returner à en cours de validation</button>
                        </form>

                    </td>
                    <td>
                        <form action="{{ route('admin.demande.destroy', $demande->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Est ce que vous êtes sûre de supprimer cette demande?')" type="submit" class="btn btn-danger m-2">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
