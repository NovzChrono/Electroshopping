@extends('layouts.front')

@section('title',$materiel -> nom_mat)

@section('content')

@php
    $moy = number_format($note_moy)
@endphp

<!-- Etoiles -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/ajout-note') }}" method="post">
                @csrf
                <input type="hidden" name="materiel_id" value="{{$materiel -> id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notez {{$materiel -> tag}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="rating-css">
                        <div class="star-icon">
                            @if ($note)
                                @for($i=1 ; $i<=$note->note ; $i++)
                                    <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                @endfor
                                @for($i=$note->note+1;$i<=5;$i++)
                                    <input type="radio" value="{{$i}}" name="product_rating" id="rating{{$i}}">
                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                @endfor
                                <br>
                                <label for="commentaire" class="fs-5">Commentaire</label>
                                <textarea name="commentaire" id="commentaire" class="form-control fs-5 cols="30" rows="10">{{ $note -> commentaire }}</textarea>
                            @else
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                                <br>
                                <label for="commentaire" class="fs-5">Commentaire</label>
                                <textarea name="commentaire" id="commentaire" class="form-control fs-5" cols="20" rows="5"></textarea>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulé</button>
                    <button type="submit" class="btn btn-primary">OK</button>
                </div>
        </form>
        </div>
    </div>
</div>

<!-- End Etoiles -->

<!-- Details materiel -->

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Détails</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $materiel -> gdescription_mat }}
            </div>
        </div>
    </div>
</div>

<!-- End Detail materiel -->

<!-- Note materiel -->

<div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteModalLabel">Notes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="text-center text-uppercase h5">
                            AVIS vérifiés ({{ $nb_cmt }})
                        </div>
                        <div class="card py-3 mb-3 bg-light border-0">
                            <div class="card-body">
                                <div class="text-center h3" style="color:#ffce05">{{ $moy }}/5</div>
                                @if($note_moy > 0)
                                    <div for="" class=" text-center">
                                        <div class="rating">
                                            @for($i=1;$i<=$moy;$i++)
                                                <i class="fa fa-star" style="color:#ffce05;font-size:1.3em"></i>
                                            @endfor
                                            @for($i=$moy+1;$i<=5;$i++)
                                                <i class="fa fa-star" style="color:#e1decf"></i>
                                            @endfor
                                        </div>
                                        @if($nb_cmt > 0)
                                            <div class="h5 text-center pt-2">{{ $nb_cmt }} avis vérifiés </div>
                                        @endif
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class=" text-uppercase h5">commentaires </div>
                        @foreach($notes as $item)
                            <div class="card border-0 border-bottom mt-1">
                                <div class="card-body text-danger bg-white border-0 ">
                                    <div>
                                        <i>
                                            <i class="fa fa-user"></i>
                                            <span class=" text-uppercase">{{  $item -> users -> name }} </span>
                                            <span class=" text-capitalize">{{ $item -> users -> pnom }}</span>
                                        </i>
                                    </div>
                                    @for($i=1;$i<=$item->note;$i++)
                                        <i class="fa fa-star" style="font-size:1.2em;color:#ffce05"></i>
                                    @endfor
                                    @for($i=$item->note+1;$i<=5;$i++)
                                        <i class="fa fa-star" style="color:#e1decf"></i>
                                    @endfor
                                    <br>
                                    <span class="text-dark pt-2">{{ $item -> commentaire }}</span> <br>
                                    <span class=" float-end fs-6" style="color:#b4b4ae"><i>Modifiée le :{{ date('d - m - Y à H:i:s', strtotime($item -> updated_at)) }}</i></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- End Note materiel -->

<!-- img1 materiel -->

<div class="modal fade" id="imgModal" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="imgModalLabel" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{{ $materiel->nom_mat }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex py-5 justify-content-center">
                    <img class="" height="350" width="350"  data-bs-toggle="modal" data-bs-target="#imgModal" id="image-1" src="{{asset('assets/uploads/materiel/'. $materiel -> image_mat )}}" alt="materiel">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End img1 materiel -->

<!-- img2 materiel -->

@if ($materiel -> image2_mat != '')
    <div class="modal fade" id="img2Modal" tabindex="-1" aria-labelledby="img2ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" id="img2ModalLabel">{{ $materiel->nom_mat }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex py-5 justify-content-center">
                        <img class="" height="350" width="350" id="image-2"  src="{{asset('assets/uploads/materiel2/'. $materiel -> image2_mat )}}" alt="materiel">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- End img2 materiel -->

<!-- img3 materiel -->

@if ($materiel -> image3_mat != '')
    <div class="modal fade" id="img3Modal" tabindex="-1" aria-labelledby="img3ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" id="img3ModalLabel">{{ $materiel->nom_mat }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex py-5 justify-content-center">
                        <img class="" height="350" width="350" id="image-3"  src="{{asset('assets/uploads/materiel3/'. $materiel -> image3_mat )}}" alt="materiel">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- End img3 materiel -->

<!-- Lien autres pages -->

<div class="py-2 pb-3" >
    <div class="container text-capitalize">
        <div class="mb-0 fs-6 " style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
            <a class="text-dark" href="{{ route('accueil')}}">Acceuil</a>  
            > <a class="text-dark" href="{{ route('categorie')}}">Collections</a> 
            > <a class="text-dark" href="{{ url('all-materiel')}}"> All </a> 
            > <a class="text-dark text-capitalize" href="{{ url('categorie/'.$materiel->categorie_materiel->libelleCatMat)}}" > {{$materiel->categorie_materiel->libelleCatMat}}</a> 
            > <a class="text-dark text-capitalize"  href="{{ url('/marque/'.$materiel -> marque_id) }}">{{ $materiel -> marque -> nom }}</a>
            > {{$materiel->nom_mat}}
        </div>
    </div>
</div>

<!-- Lien autres pages -->

<!-- Affiche donnée materiel -->

<div class="container mb-5">
    <div class="card border-0 shadow materiel-data py-3">
        <div class="card-body">
            <div class="row pb-3">
                <div class="col-md-4 text-center py-5" style="cursor: zoom-in">
                    @if ($materiel -> image2_mat != '' || $materiel -> image3_mat != '')
                        <div class="owl-carousel M-carousel owl-theme">
                            <img class="" height="240" data-bs-toggle="modal" data-bs-target="#imgModal" id="image-1" src="{{asset('assets/uploads/materiel/'. $materiel -> image_mat )}}" alt="materiel">
                            @if ($materiel -> image2_mat != '')
                                <img class="" height="240" data-bs-toggle="modal" data-bs-target="#img2Modal" id="image-2"  src="{{asset('assets/uploads/materiel2/'. $materiel -> image2_mat )}}" alt="materiel">
                            @endif
                            @if ($materiel -> image3_mat != '')
                                <img class="" height="240" data-bs-toggle="modal" data-bs-target="#img3Modal" id="image-3" src="{{asset('assets/uploads/materiel3/'. $materiel -> image3_mat )}}" alt="materiel">
                            @endif
                        </div>
                    @else
                        <img class="" height="240" data-bs-toggle="modal" data-bs-target="#imgModal" id="image-1" src="{{asset('assets/uploads/materiel/'. $materiel -> image_mat )}}" alt="materiel">
                    @endif
                </div>
                <div class="col-md-8">
                    <h3 class="mb-0 text-capitalize mb-3">
                        {{$materiel -> nom_mat}}
                    </h3>
                    <h6 class=" text-capitalize">Marque : <a href="{{ url('/marque/'.$materiel ->marque_id) }}">{{ $materiel ->marque->nom }}</a></h6>
                    @if($note_moy > 0)
                        <div for="" class="">
                            <div class="rating">
                                @for($i=1;$i<=$moy;$i++)
                                    <i class="fa fa-star" style="color:#ffce05"></i>
                                @endfor
                                @for($i=$moy+1;$i<=5;$i++)
                                    <i class="fa fa-star" style="color:#e1decf"></i>
                                @endfor
                                @if($nb_cmt > 0)
                                    ( {{ $nb_cmt }} avis verifiés )
                                @endif
                            </div>
                        </div>
                    @endif
                    @if ($materiel -> qte_mat > 0)
                        <label for="" class="badge bg-success">Stocké</label>
                    @else
                        <label class="badge bg-danger">Rupture de stock</label>
                    @endif
                    @if ($materiel -> popular_mat == '1')
                        <a href="{{ url('/tendance') }}"><span style="" class="badge bg-warning trending-tag" for="">Tendance</span></a>
                    @endif
                    @if ($materiel -> marque_mat != '')
                        <a href="{{ url('/marque/'.$materiel ->marque_mat) }}"><span class="badge bg-dark text-capitalize">{{ $materiel -> marque_mat }}</label></a>
                    @endif
                    <hr>
                    <h3 for="" class="fw-bold" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">{{$materiel -> prixreduit_mat}} FCFA</h3>
                    @if($materiel ->prixnormal_mat != 1)
                        <h5 for="" class="me-3 font-italic"><s><i>{{$materiel -> prixnormal_mat}} FCFA</i></s></h5>
                    @endif
                    <h6 class="mb-4"><i>+ Livraison sous 24H partout à Yamoussoukro</i></h6>
                    <div class="row mt-2">
                        @if ($materiel -> qte_mat > 0)
                            <div class="col-md-3">
                                <input type="hidden" value="{{$materiel -> id}}" class="mat_id">
                                <label for="nb">Quantité</label>
                                <div class="input-group text-center mb-3 pt-1">
                                    <button class="input-group-text btn btn-warning text-white opacity-75 decrement-btn">-</button>
                                    <input type="text" name="nb" width="25px" class="text-center nb-input bg-white  form-control" value="1">
                                    <button class="input-group-text btn btn-warning text-white opacity-75 increment-btn">+</button>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-9">
                            <br>
                            <div class="row">
                                @if ($materiel -> qte_mat > 0)
                                    <div class="col-md-4 text-center">
                                        <button type="submit" class="mt-1 btn w-100 btn-primary me-3 ajoutPanierBtn">Ajout au panier <i class="fa fa-shopping-cart"></i></button>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <button type="submit" class="mt-1 btn w-100 btn-success me-3 ajoutFavorie">Element souhaité <i class="fa fa-heart"></i></button>
                                    </div>
                                @else
                                    <div class="col-md-4 text-center">
                                        <button type="submit" class="mt-1 w-100 btn btn-success me-3 ajoutFavorie">Element souhaité <i class="fa fa-heart"></i></button>
                                    </div>
                                @endif
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            
            <div class="row">
                @if($ok == 1)
                    <div class="col-md-10">
                        <h3>Description</h3>
                        <p class="mt-3">
                            {!! $materiel -> description_mat !!} <br>
                            <span class="float-end fs-6"><a href="" data-bs-toggle="modal" data-bs-target="#detailModal" class="text-decoration-underline"><i>Voir plus de détails <i class="fa-solid fa-arrow-right-long"></i></i></a></span>
                        </p>
                    </div>
                    <div class="col-md-2">
                        <span class="float-end">
                            <button type="button" class="btn btn-primary text-white mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            @if($exist_note == 0)
                                Noté le produit
                            @else
                                Modifié le produit
                            @endif
                            </button>
                            @if ($note != '')
                                <div class="text-dark">Votre note :</div>
                                <div class="rating text-center">
                                    @for($i=1;$i<=$note->note;$i++)
                                        <i class="fa fa-star" style="color:#ffce05"></i>
                                    @endfor
                                    @for($i=$note->note+1;$i<=5;$i++)
                                        <i class="fa fa-star" style="color:#e1decf"></i>
                                    @endfor
                                </div>
                            @endif
                        </span>
                    </div>
                @else
                    <div class="col-md-12">
                        <h3>Description</h3>
                        <p class="mt-3">
                            {!! $materiel -> description_mat !!} <br>
                            <span class="float-end fs-6"><a href="" data-bs-toggle="modal" data-bs-target="#detailModal" class="text-decoration-underline"><i>Voir plus de détails <i class="fa-solid fa-arrow-right-long"></i></i></a></span>
                        </p>
                    </div>
                @endif
            </div>
        </div>
        @if($notes->count() > 0)
            <div class="card-footer bg-transparent">
                @foreach($notes_limit as $item)
                    <div class="card border-0 border-bottom mt-1">
                        <div class="card-body text-danger bg-white border-0 ">
                            <div>
                                <i>
                                    <i class="fa fa-user"></i>
                                    <span class=" text-uppercase">{{  $item -> users -> name }} </span>
                                    <span class=" text-capitalize">{{ $item -> users -> pnom }}</span>
                                </i>
                            </div>
                            @for($i=1;$i<=$item->note;$i++)
                                <i class="fa fa-star" style="font-size:1.2em;color:#ffce05"></i>
                            @endfor
                            @for($i=$item->note+1;$i<=5;$i++)
                                <i class="fa fa-star" style="color:#e1decf"></i>
                            @endfor
                            <br>
                            <span class="text-dark pt-2">{{ $item -> commentaire }}</span> <br>
                            <span class=" float-end fs-6" style="color:#b4b4ae"><i>Modifiée le :{{ date('d - m - Y à H:i:s', strtotime($item -> updated_at)) }}</i></span>
                        </div>
                    </div>
                @endforeach
                @if ($nb_cmt > 3)
                    <span class="float-end fs-6"><a href="" class="text-decoration-underline" data-bs-toggle="modal" data-bs-target="#noteModal"><i>Voir plus de notes <i class="fa-solid fa-arrow-right-long"></i></i></a></span>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Affiche donnée materiel -->

@endsection

@section("scripts")
    <script src="{{ asset('js/viewmateriel.js') }}"></script>
@endsection