@extends('layouts.main')

@section('title')
    DSI stage app
@endsection

@section('content')
    <div class="container">
        <div class="row my-4">
            <section class="col-md-6">
                <h1 class="h1 my-5">Devenez Stagaire chez DSI</h1>
                <p class="my-5">
                    La Direction du système d'information a pour missions de:

                    Concevoir, mettre en place et suivre le système d'information statistique du Ministère;

                    Réaliser des études à caractère organisationnel;

                    Contribuer à l'élaboration du schéma directeur informatique du Ministère et des académies régionales d'éducation et de
                    formation.

                    La Direction du système d'information est composée de:
                    <ul>
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
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-dark">S'inscrire</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-dark">Se connecter</a>
                    @endguest
                    @auth
                        <a href="{{ route('home') }}" class="btn btn-dark">Dashboard</a>
                    @endauth
                </div>
            </section>
            <section class="col-md-6">
                <img src="{{ asset('images/logo_ministere_education_nationale.png') }}" alt="ministere education nationale" class="mx-5 my-5" />
                <img src="{{ asset('images/image_programmers.jpg') }}" alt="image_programmers" />
            </section>
        </div>

    </div>
@endsection
