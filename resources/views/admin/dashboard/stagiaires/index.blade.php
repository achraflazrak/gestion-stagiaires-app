@extends('layouts.dashboard.main')
@section('title')
Stagiaires
@endsection

@section('content')
    <div class="container">
        @if(Session::has('msg'))
            <div class="alert alert-success">
                {{ Session::get('msg') }}
            </div>
        @endif

        <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CIN</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Date de naissance</th>
                        <th scope="col">Sexe</th>
                        <th scope="col">Plus des infos</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stgs as $key => $stg)
                    <tr>
                        <th scope="row">{{ $stg->id }}</th>
                        <td>{{ Str::upper($stg->cin) }}</td>
                        <td>{{ Str::ucfirst($stg->nom) }}</td>
                        <td>{{ Str::ucfirst($stg->prenom) }}</td>
                        <td>{{ \Carbon\Carbon::parse($stg->dateN)->format('d/m/Y') }}</td>
                        <td>{{ Str::upper($stg->sexe) }}</td>
                        <td class="d-flex px-5 justify-content-around align-items-center">
                            <a href="{{ route('admin.stg.show', $stg->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        </td>
                        <td>
                            <form action="{{ route('admin.stg.destroy', $stg->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Est ce que tu es sûre de supprimer ce stagiaire?')" type="submit" class="btn btn-danger">
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
