@extends('layouts.main')

@section('title')
About
@endsection

@section('content')
<div class="container">
    <div class="row my-4">
        <section class="col-md-12">
            <h1 class="h1 my-5">A propos de nous</h1>
            <p class="my-5">
                    La Direction du système d'information a pour missions de:

                    Concevoir, mettre en place et suivre le système d'information statistique du Ministère;

                    Réaliser des études à caractère organisationnel;

                    Contribuer à l'élaboration du schéma directeur informatique du Ministère et des académies régionales d'éducation et de
                    formation.

                    La Direction du système d'information est composée de:
                    <ul class="mb-3">
                        <li>Division de la stratégie informatique.</li>
                        <li>Service des études informatiques.</li>
                        <li>Service de pilotage des schémas directeurs informatiques.</li>
                        <li>Centre informatique.</li>
                        <li>Service de l'administration de la banque de données statistiques.</li>
                        <li>Service de la gestion de la logistique informatique et de l'administration des réseaux.</li>
                        <li>Le Centre informatique a rang de division de l'administration centrale.</li>
                    </ul>
            </p>
            <div class="d-flex justify-content-around align-items-center my-5">
                <a href="{{ route('accueil') }}" class="btn btn-dark fw-bold">RETOUR A LA PAGE D'ACCUEIL</a>
            </div>
        </section>
    </div>

</div>
@endsection
