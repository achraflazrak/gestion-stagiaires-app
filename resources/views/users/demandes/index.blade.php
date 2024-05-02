@extends('layouts.users.main')
@section('title')
Demandes
@endsection

@section('content')
<div class="container">
    @if(session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    @if(session('msgErr'))
        <div class="alert alert-danger">{{ session('msgErr') }}</div>
    @endif
    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Id de l'offre de stage</th>
                <th scope="col">Sujet de l'offre de stage</th>
                <th scope="col">Votre C.V</th>
                <th scope="col">Lettre de motivation</th>
                <th scope="col">Statut</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($demandes as $key => $demande)
            <tr>
                <th scope="row">{{ $demande->id }}</th>
                <td>#{{ $demande->offre->id }}</td>
                <td>{{ Str::ucfirst($demande->offre->sujet) }}</td>
                <td>
                    <a href="{{ route('user.demande.cv.pdf', basename($demande->user->cv, '.pdf')) }}" target="_blank"
                        class="btn btn-success"><i class="fas fa-eye"></i></a>
                    </a>
                </td>
                <td>
                    <a href="{{ route('user.demande.lm.pdf', basename($demande->lettre_motivation, '.pdf')) }}" target="_blank"
                        class="btn btn-success"><i class="fas fa-eye"></i></a>
                </td>
                <td>
                    <span
                        class="badge p-2 text-bg-{{ $demande->is_accept === null? 'primary' : ($demande->is_accept? 'success': 'danger') }}">
                        {{ $demande->is_accept === null? 'En cours de validation' : ($demande->is_accept? 'Accepter' :
                        'Refuser') }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('user.demande.edit', $demande->id) }}" class="btn btn-primary"><i
                         class="fas fa-pencil"></i></a>

                    <form action="{{ route('user.demande.destroy', $demande->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Est ce que vous êtes sûre de supprimer cette demande?')"
                            type="submit" class="btn btn-danger m-2">
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
