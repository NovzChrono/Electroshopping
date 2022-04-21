@extends('layouts.front')

@section('title')
    Recherches sur {{ $marque -> nom }}
@endsection

@section('content')
    <div class="py-2 pb-3" >
        <div class="container text-capitalize">
            <div class="mb-0 fs-6"> 
                <a class="text-dark" href="{{ route('accueil')}}">Acceuil</a>   >
                <a class="text-dark" href="{{ route('categorie')}}">Collections</a>   > 
                <a class="text-dark" href="{{ url('all-materiel')}}"> All </a> >
                {{$marque -> nom}}
            </div>
        </div>
    </div>
    @if($materiels -> count() > 0)
        <div class="">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-md-3 mb-2 d-none d-sm-block ">
                        <div class="card border-0">
                            <div class="card-body">
                                <h5 class=" text-uppercase mb-3">catégorie</h5>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        @foreach ($categories as $item)
                                            <h6 class="mb-3"><a class="text-dark" href="{{ url('/marque/'.$marque->id .'/'. $item-> libelleCatMat) }}">{{ $item-> libelleCatMat }}</a></h6>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 mb-3" id="table_data">
                        <div class="">
                            <div class="card border-0">
                                <div class="card-header bg-white fs-5" style="color:rgb(136, 133, 133)">
                                    {{ $count }} résultats
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($materiels as $item)
                                            <div class="col-md-3 mb-3 pt-1 rounded hover_mat">
                                                <a class="text-decoration-none text-black" href="{{url('/categorie/'.$item->categorie_materiel->libelleCatMat .'/'.$item->id)}}">
                                                    <div class="card border-0">
                                                        <center><img class="card-img-top img-materiel"  src="{{asset('assets/uploads/materiel/'. $item->image_mat)}}" alt="img produit"></center>
                                                        <div class="card-body">
                                                            <p style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{{$item->nom_mat}}</p>
                                                            <h5 class="">{{$item->prixreduit_mat}} FCFA</h5>
                                                            @if($item->prixnormal_mat != 1)
                                                                <h6 class=""><s>{{$item->prixnormal_mat}} FCFA</s></h6>
                                                            @endif
                                                            @php
                                                                $sum = $item -> taux -> sum('note');
                                                                $nbr = $item -> taux -> count();

                                                                if ($sum === 0) {
                                                                    $nbr = 1;
                                                                }

                                                                $moy = $sum / $nbr;
                                                                $moy = number_format($moy)
                                                            @endphp

                                                            @if ($moy > 0)
                                                                <div class="rating p-0">
                                                                    @for($i=1;$i<=$moy;$i++)
                                                                        <i class="fa fa-star" style="color:#ffce05;font-size:0.9em"></i>
                                                                    @endfor
                                                                    @for($i=$moy+1;$i<=5;$i++)
                                                                        <i class="fa fa-star" style="color:#e1decf;font-size:0.9em"></i>
                                                                    @endfor
                                                                    @if($nbr > 0)
                                                                        <span style="color:#807d72;font-size:0.9em">({{ $nbr }})</span>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                     {{ $materiels ->links('layouts.inc.paginatelinks') }}
                                </div>
                            </div>
                        </div>
                    </div>
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

@section('scripts')
    <script>

    </script>
@endsection
