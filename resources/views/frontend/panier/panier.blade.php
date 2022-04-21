@extends('layouts.front')

@section('title')
    Panier
@endsection

@section('content')
    <div class="py-3 mb-4" >
        <div class="container">
            <div class="mb-0 fs-6 text-dark">
                <a class="text-dark" href="{{ route('accueil')}}">Acceuil</a> > <a class="text-dark" href="{{ route('panier')}}">Panier</a>
            </div>
        </div>
    </div>
    <div class="container panier">
        @if($panier)
            <div class="container my-5">
                <div class="card shadow">
                    <div class="card-body">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($panier as $item)
                            <a class="text-dark" href="{{ url('/categorie/'.$item -> materiels -> categorie_materiel -> libelleCatMat . '/'. $item -> materiels -> id) }}">
                                <div class="row materiel-data border shadow mb-2 pt-3 pb-3">
                                    <div class="col-md-2 text-center pt-1">
                                        <img width="70px" height="70px" src="{{ asset('assets/uploads/materiel/'. $item -> materiels -> image_mat)}}" alt="">
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <br>
                                        <p style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{{$item -> materiels -> nom_mat }}</p>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <br>
                                        <h5>{{$item -> materiels -> prixreduit_mat }}</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" class="mat_id" value="{{ $item -> materiel_id }}">
                                        @if ($item->materiels->qte_mat >=  $item->qte_mat)
                                            <label for="nb">Quantité</label>
                                            <div class="input-group text-center mb-3">
                                                <button class="input-group-text decrement-btn btn btn-warning text-white opacity-75 changeQte">-</button>
                                                <input type="text" name="nb" value="{{$item -> qte_mat }}" class="text-center bg-white nb-input form-control">
                                                <button class="input-group-text increment-btn btn btn-warning text-white opacity-75 changeQte">+</button>
                                            </div>
                                            @php $total += $item -> materiels -> prixreduit_mat * $item -> qte_mat; @endphp
                                        @else
                                            <br>
                                            <div class="bg-danger text-center text-white fs-5">Rupture de stock</div>
                                        @endif
                                    </div>
                                    <div class="col-md-2 ms-auto text-center">
                                        <br>
                                        <button class="btn btn-outline-danger sup-mat-panier"><i class="fa fa-trash"></i> Supprimé</button>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="card-footer text-center pt-3">
                        <h5>Total : {{ $total }} XOF</h5>
                        <div class="fs-4 pt-1">
                            <a href="{{url('/verifie')}}" class="btn btn-outline-success">
                                Procedé au verification
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="card bg-light border-0">
                    <div class=" text-center" ><img class="card-img opacity-25 w-25" src="{{asset('assets/xMark.png')}}" alt="xMark"></div>
                    <div class="container py-5 text-uppercase text-center text-danger opacity-50 fs-5">pas de materiels dans le panier</div>
                </div>
            </div>
        @endif
    </div>
    
@endsection

@section('scripts')
<script>

</script>
@endsection
