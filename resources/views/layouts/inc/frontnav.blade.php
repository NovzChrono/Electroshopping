<nav class="navbar  navbar-expand-lg navbar-light bg-white p-0 m-0 sticky-top" >
    <div class="container">
        <a class="navbar-brand mb-0 me-0" href="{{route('accueil')}}">
            <img src="{{ asset('assets/annonce/logo.png')}}" class="" alt="logo" srcset="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            @if (Route::has('login'))
                <ul class="navbar-nav me-auto mb-1 ms-1 mb-lg-0">
                    <li class="nav-item mt-2 d-none d-xxl-block d-lg-block d-xl-block">
                        <form id="forms" method="get" action="{{ route('rechercher') }}">
                            @csrf
                            <div class="form-inputs">
                                <input id="rech_materiel" name="search" class="form-control"  type="text" placeholder="Recherche..." aria-label="Search"><i class="fa-solid fa-search fs-5"></i>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item fs-5 mt-2 d-xxl-none d-xl-none d-lg-none ">
                        <i class="fa-duotone fa-search" style="font-size:1.6em;" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                    </li>
                    <li class="nav-item ms-3">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{route('panier')}}">
                            <i class="fa-solid fa-bag-shopping" style="font-size:1.6em"><sup style="font-size:0.7em"  class=" p-1 rounded-circle panier-count opacity-100 ">0</sup></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{route('favories')}}">
                            <i class="fa-solid fa-heart text-danger" style="font-size:1.6em"><sup style="font-size:0.7em"  class=" p-1 rounded-circle favories-count opacity-100 ">0</sup></i>
                        </a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link fs-5 text-capitalize" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-duotone fa-user-headset me-1" style="font-size:1.5em"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item nav-link text-dark" href="{{url('/mes-commandes')}}">Commandes</a></li>
                                    <li><a class="dropdown-item nav-link text-dark" href="{{route('favories')}}">Liste d'envies</a></li>
                                    <li><a class="dropdown-item nav-link border-bottom text-dark" href="{{ route('profil')  }}">Mon profil</a></li>
                                    <li class="text-center">
                                        <a class="m-2 btn btn-warning text-center nav-link" style="box-shadow: 0px 2px .3em rgb(148, 147, 147)" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Se deconnecter') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item dropdown ">
                                <a class="nav-link fs-5 text-capitalize" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-flex"><i class="fa-duotone fa-right-to-bracket me-1" style="font-size:1.6em"></i><span class="pt-2">Connexion</span></span>
                                </a>
                                <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdownMenuLink">
                                    <li class="text-center border-bottom"><a class="m-2 btn btn-warning text-center fs-5 nav-link" style="box-shadow: 0px 2px .3em rgb(148, 147, 147)" href="{{ route('login') }}">Se connecter</a></li>
                                    @if (Route::has('register'))
                                        <li class="text-center"><a class="dropdown-item fs-5 text-dark nav-link" href="{{ route('register') }}">S'inscrire</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </span>
            @endif
        </div>
    </div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body">
                <form id="forms" method="get" action="{{ route('rechercher') }}">
                    @csrf
                    <div class="form-inputs">
                        <input id="rech_materiels" name="search" class="form-control"  type="text" placeholder="Recherche..." aria-label="Search">
                        <i class="fa-duotone fa-close fs-5" data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>