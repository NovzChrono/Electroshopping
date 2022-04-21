@extends('layouts.front')

@section('title')
    Bienvenue sur Electroshopping
@endsection
@section('content')
    <div class="container-fluid p-0" style="background-image: url('{{ asset('assets/img/back3.jpg') }}')" >
        <div class="pb-3" style="">
            <div class="container pt-2">
                <div class="row">
                    <div class="col-md-2 bg-white rounded-3 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block " >
                        <div class="ms-2 mt-1 fs-5">Collections</div>
                        <div class="row">
                            <div class="col-md-12 ms-4 mt-2 hover_lien text-dark">
                                <div class="row">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-desktop"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <a href="{{ url('/categorie/Ordinateur') }}" class="text-dark hover_lien">
                                            Ordinateurs
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ms-4 mt-2 hover_lien text-dark">
                                <div class="row">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-mobile-notch"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <a href="{{ url('/categorie/Smartphone') }}" class="text-dark hover_lien">
                                            Smartphones
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ms-4 mt-2 hover_lien text-dark">
                                <div class="row">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-watch-smart"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <a href="{{ url('/categorie/Montre') }}" class="text-dark hover_lien">
                                            Montres
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ms-4 mt-2 hover_lien text-dark">
                                <div class="row">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-print"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <a href="{{ url('/categorie/Imprimante') }}" class="text-dark hover_lien">
                                            Imprimantes
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ms-4 mt-2 hover_lien text-dark">
                                <div class="row">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-keyboard"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <a href="{{ url('/categorie/Clavier') }}" class="text-dark hover_lien">
                                            Claviers
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ms-4 mt-2 hover_lien text-dark">
                                <div class="row">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-computer-mouse"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <a href="{{ url('/categorie/Souris') }}" class="text-dark hover_lien">
                                            Souris
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ms-4 mt-2 hover_lien text-dark">
                                <div class="row">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-hard-drive"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <a href="{{ url('/categorie/Disque Dur') }}" class="text-dark hover_lien">
                                            Disque Durs
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ms-4 mt-2 hover_lien text-dark">
                                <div class="row">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-palette"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <a href="{{ url('/categorie/Cartouche') }}" class="text-dark hover_lien">
                                            Cartouches
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ms-4 mt-2 hover_lien text-dark">
                                <div class="row">
                                    <div class="col-md-1">
                                        <i class="fa-solid fa-droplet"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <a href="{{ url('/categorie/Encre') }}" class="text-dark hover_lien">
                                            Encres
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        @include('layouts.inc.slider')
                    </div>
                </div>
            </div>

            <!-- dernier ajout -->
            <div class="py-5 pt-3 pb-0">
                <div class="container bg-white rounded-3">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="row pb-2 bg-warning rounded-top">
                                <div class="col-md-12 bd-highlight mt-2 ">
                                    <span class="p-2 text-dark fs-5"><i class="fas fa-angles-down "></i></span>
                                    <span class=" fs-5">Derniers Ajouts</span>
                                    <span class="float-end"><a href="{{ url('/all-materiel') }}" class="fs-5 text-dark"><i>Voir plus </i> <i class="fa-solid fa-angle-right "></i></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="owl-carousel auto-carousel owl-theme">
                            @foreach ($articles_dernier as $mat )
                                <div class="col hover_mat rounded">
                                    <div class="item">
                                        <div class="card border-0 m-1">
                                            <a class="text-black" href="{{url('categorie/'.$mat -> categorie_materiel -> libelleCatMat.'/'.$mat->id)}}">
                                                <div class="card-img"><img style="height:180px;" src="{{asset('assets/uploads/materiel/'. $mat->image_mat)}}" class="" alt="img produit"></div>
                                                <div class="card-body">
                                                    <p  style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" >{{$mat->nom_mat}}</p>
                                                    <h5 class="">{{$mat->prixreduit_mat}} FCFA</h5>
                                                    @if($mat->prixnormal_mat != 1)
                                                        <h6 class=""><s>{{$mat->prixnormal_mat}} FCFA</s></h6>
                                                    @else
                                                        <h6 class="text-white"><s>{{$mat->prixnormal_mat}} FCFA</s></h6>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- tout les materiels -->
            <div class="py-5 pt-3 pb-0">
                <div class="container bg-white rounded-3">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="row pb-2 bg-warning rounded-top">
                                <div class="col-md-12 bd-highlight mt-2 ">
                                    <span class="p-2 text-dark fs-5"><i class="fas fa-star "></i></span>
                                    <span class="fs-5">Tendances</span>
                                    <span class="float-end"><a href="{{ url('/tendance') }}" class="fs-5 text-dark"><i>Voir plus </i> <i class="fa-solid fa-angle-right"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="owl-carousel auto-carousel owl-theme">
                            @foreach ($tendances as $item )
                                <div class="col hover_mat">
                                    <div class="item">
                                        <div class="card m-1 border-0">
                                            <a class="text-black" href="{{url('categorie/'.$item -> categorie_materiel -> libelleCatMat.'/'.$item->id)}}">
                                                <div class="card-img"><img style="height:180px;" src="{{asset('assets/uploads/materiel/'. $item->image_mat)}}" class="" alt="img produit"></div>
                                                <div class="card-body">
                                                    <p  style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" >{{$item->nom_mat}}</p>
                                                    <h5 class="">{{$item->prixreduit_mat}} FCFA</h5>
                                                    @if($item->prixnormal_mat != 1)
                                                        <h6 class=""><s>{{$item->prixnormal_mat}} FCFA</s></h6>
                                                    @else
                                                        <h6 class="text-white"><s>{{$item->prixnormal_mat}} FCFA</s></h6>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- toutes les marques -->
            <div class="py-5 pt-3 pb-0">
                <div class="container bg-white rounded-3">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row pb-2 bg-warning rounded-top">
                                <div class="col-md-12 bd-highlight mt-2 ">
                                    <span class="p-2 text-dark fs-5"><i class="fa-brands fa-apple"></i></span>
                                    <span class="fs-5">Marques</span>
                                    <span class="float-end"><a href="{{ route('marque') }}" class="fs-5 text-dark"><i>Voir plus </i> <i class="fa-solid fa-angle-right"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="owl-carousel CM-carousel owl-theme">
                            @foreach ($marques as $marque )
                                <div class="col hover_mat">
                                    <div class="item">
                                        <a class="text-decoration-none text-black" href="{{url('/marque/'.$marque->id)}}">
                                            <div class="card border-0 m-1">
                                                <div class=""><img style="height:190px;" src="{{asset('assets/uploads/marque/'. $marque->logo)}}" class="card-img" alt="img produit"></div>
                                                <div class="card-body">
                                                    <h5><center>{{$marque->nom}}</center></h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- tout les categories -->
            <div class="py-5 pt-3 pb-0">
                <div class="container bg-white rounded-3">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row pb-2 bg-warning rounded-top">
                                <div class="col-md-12 bd-highlight mt-2 ">
                                    <span class="p-2 text-dark fs-5"><i class="fas fa-object-group"></i></span>
                                    <span class="fs-5">Categories de materiels</span>
                                    <span class="float-end"><a href="{{ route('categorie') }}" class="fs-5 text-dark"><i>Voir plus </i> <i class="fa-solid fa-angle-right"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="owl-carousel CM-carousel owl-theme">
                            @foreach ($categories as $categorie )
                                <div class="col hover_mat">
                                    <div class="item">
                                        <a class="text-decoration-none text-black" href="{{url('/categorie/'.$categorie->libelleCatMat)}}">
                                            <div class="card border-0 m-1">
                                                <div class=""><img style="height:190px;" src="{{asset('assets/uploads/categorie/'. $categorie->imageCatMat)}}" class="card-img" alt="img produit"></div>
                                                <div class="card-body">
                                                    <h5><center>{{$categorie->libelleCatMat}}</center></h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section("scripts")
    <script>$('.CM-carousel').owlCarousel({ loop:true, margin:10, nav:false, dots:false, responsive:{ 0:{ items:2 }, 600:{ items:3 }, 1000:{ items:5} }}); $('.auto-carousel').owlCarousel({ loop:true, margin:10, nav:false, dots:false, autoplay:true, autoplayTimeout:8000, autoplayHoverPause:true, responsive:{0:{ items:2 }, 600:{ items:3 }, 1000:{    items:5 } } })</script>
@endsection
