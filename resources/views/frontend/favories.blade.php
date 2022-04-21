@extends('layouts.front')

@section('title','Ma liste de favories')

@section('content')
<div class="py-3 mb-4">
    <div class="container">
        <div class="mb-0 fs-6 text-dark">
            <a class="text-dark" href="{{ route('accueil')}}">Acceuil</a> > <a class="text-dark" href="{{ route('favories')}}">Liste d'envie</a>
        </div>
    </div>
</div>
<div class="container favorie">
    @if($favories->count() > 0)
        <div class="container my-5">
            <div class="card shadow">
                <div class="card-body">
                    @foreach ($favories as $item)
                        <a class="text-dark" href="{{ url('/categorie/'.$item -> materiels -> categorie_materiel -> libelleCatMat . '/'. $item -> materiels -> id) }}" >
                            <div class="row materiel-data border shadow mb-2 pt-3 pb-3">
                                <div class="col-md-2 text-center p-2">
                                    <img width="70px" height="70px" src="{{ asset('assets/uploads/materiel/'. $item -> materiels -> image_mat)}}" alt="">
                                </div>
                                <div class="col-md-2 p-2 text-center">
                                    <br>
                                    <p style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{{$item -> materiels -> nom_mat }}</p>
                                </div>
                                <div class="col-md-2 p-2 text-center">
                                    <br>
                                    <h5>{{$item -> materiels -> prixreduit_mat }}</h5>
                                </div>
                                @if ($item -> materiels -> qte_mat >= $item -> qte_mat)
                                    <div class="col-md-2 p-2 text-center">
                                        <br>
                                        <input type="hidden" class="mat_id" value="{{ $item -> materiel_id }}">
                                        <input type="hidden" value="{{$item-> qte_mat}}" class="mat_qte">
                                        <h5>En stock</h5>
                                    </div>
                                    <div class="col-md-2 ms-auto text-center">
                                        <br>
                                        <button class="btn btn-outline-success ajout-mat-panier"><i class="fa fa-shopping-cart"></i> Ajout au panier</button>
                                    </div>
                                @else
                                    <div class="col-md-3 text-center">
                                        <br>
                                        <input type="hidden" class="mat_id" value="{{ $item -> materiel_id }}">
                                        <h5 class="bg-danger p-2 text-white">Rupture de stock</h5>
                                    </div>
                                @endif
                                <div class="col-md-2 ms-auto text-center">
                                    <br>
                                    <button class="btn btn-outline-danger sup-mat-favorie"><i class="fa fa-trash"></i> Supprimé</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @else
            <div class="container">
                <div class="card bg-light border-0">
                    <div class="py-3 text-center" ><img class="card-img opacity-25 w-25" src="{{asset('assets/xMark.png')}}" alt="xMark"></div>
                    <div class="container py-5 text-uppercase text-center text-danger opacity-50 fs-5">Liste d'envie vide</div>
                </div>
            </div>
        @endif
    @endsection
</div>

