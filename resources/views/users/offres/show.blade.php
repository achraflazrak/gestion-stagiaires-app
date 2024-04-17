@extends('layouts.main')
@section('title')
 Offres
@endsection

@section('content')
<div class="container">
    @php $counter = 0; @endphp
    @foreach ($offres as $offre)
        <div class="card my-4">
                <div class="card-header bg-dark text-center">
                    <h3 class="text-bg-dark fw-bold">Offre #{{ ++$counter }}</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <strong class="fs-5 badge bg-dark mt-0">Sujet: </strong>
                                </td>
                                <td>
                                    <h3 class="card-title">{{ Str::upper($offre->sujet) }}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="fs-5 badge bg-dark me-3">Type: </strong>
                                </td>
                                <td>
                                    <h3 class="card-title">{{ Str::ucfirst($offre->type) }}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="fs-5 badge bg-dark me-3">Durée: </strong>
                                </td>
                                <td>
                                    <h3 class="card-title">{{ $offre->duree >= 30? Str::of($offre->duree/30).' mois' :
                                        Str::of($offre->duree) .' jours' }}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="fs-5 badge bg-dark me-3">Lieu: </strong>
                                </td>
                                <td>
                                    <h3 class="card-title">{{ Str::ucfirst($offre->lieu) }}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="fs-5 badge bg-dark me-3">Description: </strong>
                                </td>
                                <td>
                                    <h3 class="card-title">{{ Str::ucfirst($offre->description) }}</h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @auth
                        @if(!auth()->user()->is_admin)
                            @if($offre->findDemandeByStgAndOffre(auth()->user()) === null)
                                <a href="{{ route('user.offre.demande.create', $offre->id) }}" class="btn btn-primary my-2 mx-2 fw-bold">Créer une demande</a>
                            @else
                                <form class='d-inline-block' action="{{ route('user.offre.demande.destroy', ['id' => -1, 'offreId' => $offre->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Supprimer la demande</button>
                                </form>
                            @endif
                        @endif
                    @endauth

                    <a href="{{ route('accueil') }}" class="btn btn-dark my-2 fw-bold">RETOUR A L'ACCUEIL</a>

                </div>
            </div>
    @endforeach
</div>

@endsection
