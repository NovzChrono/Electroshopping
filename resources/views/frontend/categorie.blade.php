@extends('layouts.front')

@section('title')
    Categories de Materiels
@endsection

@section('content')
    <div class="py-2 pb-3" >
        <div class="container text-capitalize">
            <div class="mb-0 fs-6"> 
                <a class="text-dark" href="{{ route('accueil')}}">Acceuil</a>   >
                Collection
            </div>
        </div>
    </div>
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($categorie as $item)
                            <div class="col-md-3 mb-3">
                                <a class="text-decoration-none text-black" href="{{url('/categorie/'.$item->libelleCatMat)}}">
                                    <div class="card border-0" height="x">
                                        <div ><center><img class="card-img-top img-materiel" src="{{asset('assets/uploads/categorie/'. $item->imageCatMat)}}" class=" card-img-top" alt="img categorie"></center></div>
                                        <div class="card-head py-2">
                                            <h4><center>{{$item->libelleCatMat}}</center></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $categorie ->links('layouts.inc.paginatelinks') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
