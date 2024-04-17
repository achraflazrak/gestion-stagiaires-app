@extends('layouts.dashboard.main')
@section('title')
Offres
@endsection

@section('content')
<div class="container">
    @if(Session::has('msg'))
    <div class="alert alert-success">
        {{ Session::get('msg') }}
    </div>
    @endif

    <div class="d-flex justify-content-center">
        <a href="{{ route('admin.offre.create') }}" class="btn btn-success mb-3"><i class="fas fa-add"></i></a>
    </div>
    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">Sujet</th>
                <th scope="col">Date début</th>
                <th scope="col">Durée</th>
                <th scope="col">Publication</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offres as $key => $offre)
            <tr>
                <th>{{ $offre->id }}</th>
                <td>{{ Str::ucfirst($offre->type) }}</td>
                <td>{{ Str::ucfirst($offre->sujet) }}</td>
                <td>{{ \Carbon\Carbon::parse($offre->date_debut)->format('d/m/Y') }}</td>
                <td>{{ $offre->duree >= 30? Str::of($offre->duree/30).' mois' : Str::of($offre->duree) .' jours'  }}</td>
                <td>
                    <form action="{{ route('admin.offre.publishcache', $offre->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-{{ $offre->is_published? 'success': 'danger' }}">{{ $offre->is_published? 'Oui' : 'Non'}}</button></td>
                    </form>
                <td class="d-flex px-5 justify-content-around align-items-center">
                    <a href="{{ route('admin.offre.show', $offre->id) }}" class="btn btn-primary"><i
                            class="fas fa-eye"></i></a>
                    <a href="{{ route('admin.offre.edit', $offre->id) }}" class="btn btn-info ms-2"><i class="fas fa-pencil"></i></a>
                    <form action="{{ route('admin.offre.destroy', $offre->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Est ce que tu est sûre de supprimer ce offre?')" type="submit" class="btn btn-danger ms-2"><i class="fas fa-trash"></i></button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
