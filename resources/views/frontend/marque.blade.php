@extends('layouts.front')

@section('title','Marques')

@section('content')
    <div class="py-2 pb-3" >
        <div class="container text-capitalize">
            <div class="mb-0 fs-6"> 
                <a class="text-dark" href="{{ route('accueil')}}">Acceuil</a>   >
                <a class="text-dark" href="{{ route('categorie')}}">Collection</a>   >
                Marque
            </div>
        </div>
    </div>
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($marques as $item)
                            <div class="col-md-3 mb-3 hover_mat rounded">
                                <a class="text-decoration-none text-black" href="{{url('/marque/'.$item->id)}}">
                                    <div class="card border-0" height="x">
                                        <div ><center><img class="card-img-top img-materiel" src="{{asset('assets/uploads/marque/'. $item->logo)}}" class=" card-img-top" alt="img categorie"></center></div>
                                        <div class="card-head py-2">
                                            <h4><center>{{$item->nom}}</center></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $marques ->links('layouts.inc.paginatelinks') }}
                </div>
            </div>
        </div>
    </div>
@endsection