<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('accueil') }}">DSI stage app</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('users.offers.show')? 'text-bg-light rounded-2' : 'text-light' }}" aria-current="page" href="{{ route('users.offers.show') }}">Offers de stage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('about')? 'text-bg-light rounded-2' : 'text-light' }}" href="{{ route('about') }}">A propos de nous</a>
                </li>
            </ul>
            <div class="d-flex justify-content-between align-items-center">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-light mx-3">S'inscrire</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light mx-3">Se connecter</a>
                @endguest

                @auth
                    <a href="{{ route('home') }}" class="btn btn-light mx-3">Dashboard</a>
                @endauth

            </div>
        </div>

    </div>
</nav>
