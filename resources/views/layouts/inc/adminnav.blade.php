<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="{{ url('dashboard') }}"><h4>Tableau de bord</h4></a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarText">
            <form class="navbar-form" id="forms" method="get" action="{{ route('recherche_tel') }}">
                @csrf
                <div class="input-group no-border me-3">
                    <input required type="search" id="numero_tel" name="searcht" class="form-control recherche" aria-label="Search" placeholder="Numero de telephone...">
                    <button type="submit" class="btn me-4 recherche btn-default bg-success btn-round btn-just-icon">
                        <i class=" material-icons">search</i>
                    </button>
                </div>
            </form>
            <form class="navbar-form" style="margin-left: 5%" id="form" method="get" action="{{ route('recherche_suivie') }}">
                @csrf
                <div class="input-group no-border">
                    <input required type="search" id="numero_suivie" name="search" class="form-control recherche" aria-label="Search" placeholder="Numero de suivi...">
                    <button type="submit" class="btn recherche btn-default btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                    </button>
                </div>
            </form>
            <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"">
                    <i class="material-icons person_icon">person</i>
                    <p class="d-lg-none d-md-block">
                        Compte
                    </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('compte_admin') }}">Mon profil</a>
                    <a class="dropdown-item" href="{{ url('compte_pwd') }}">Modifié le mot de passe</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Se deconnecter') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            </ul>
        </div>
    </div>
</nav>
