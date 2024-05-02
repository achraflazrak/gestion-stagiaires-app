<nav id="sidebarMenu" class="row d-md-block bg-dark sidebar" style="min-height: 82.9vh">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Route::is("admin.home")? 'text-bg-light rounded-2' : 'text-light' }}" aria-current="page" href="{{ route('admin.home') }}">
                    <i class="fas fa-dashboard"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is("admin.offres")? 'text-bg-light rounded-2' : 'text-light' }}" href="{{ route('admin.offres') }}">
                    <i class="fas fa-tags"></i>
                    Offres de stage
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is("admin.demandes")? 'text-bg-light rounded-2' : 'text-light' }}" href="{{ route('admin.demandes') }}">
                    <i class="fas fa-clipboard"></i>
                    Demandes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is("admin.stages")? 'text-bg-light rounded-2' : 'text-light' }}" href="{{ route('admin.stages') }}">
                    <i class="fas fa-briefcase"></i>
                    Stages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is("admin.stgs")? 'text-bg-light rounded-2' : 'text-light' }}" href="{{ route('admin.stgs') }}">
                    <i class="fas fa-users"></i>
                    Stagiaires
                </a>
            </li>
        </ul>
    </div>
</nav>
