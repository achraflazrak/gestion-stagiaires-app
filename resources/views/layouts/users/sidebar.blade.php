<nav id="sidebarMenu" class="row d-md-block bg-dark sidebar" style="min-height: 82.9vh">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('home')? 'text-bg-light rounded-2' : 'text-light' }}"
                    aria-current="page" href="{{ route('home') }}">
                    <i class="fas fa-home"></i>
                    Accueil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('user.infos')? 'text-bg-light rounded-2' : 'text-light' }}"
                    aria-current="page" href="{{ route('user.infos') }}">
                    <i class="fas fa-dashboard"></i>
                    Mes infos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is("user.demandes")? 'text-bg-light rounded-2' : 'text-light' }}"
                    href="{{ route('user.demandes') }}">
                    <i class="fas fa-clipboard"></i>
                    Mes Demandes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is("user.stages")? 'text-bg-light rounded-2' : 'text-light' }}"
                    href="{{ route('user.stages') }}">
                    <i class="fas fa-briefcase"></i>
                    Mes Stages
                </a>
            </li>
        </ul>
    </div>
</nav>
