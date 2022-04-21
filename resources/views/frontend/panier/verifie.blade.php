@extends('layouts.front')

@section('title')
    Verification
@endsection

@section('content')
    
    <div class="container py-5 verifie">
        @if($itempanier-> count() > 0)
            <form action="{{ url('/cmd-place')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h5>Detail Basic</h5>
                                <hr>
                                @if ($errors -> any())
                                    @foreach ($errors->All() as $error )
                                        <div class="container text-danger text-center">{{$error}}</div>
                                    @endforeach
                                    <hr>
                                @endif
                                <div class="row verifie-form">
                                    <div class="col-md-6 mt-3">
                                        <label for="un">Nom <sup class="text-danger">*</sup> </label>
                                        <input type="text" name="nomu" id="un" class="form-control nomu" value="{{ Auth::user()->name }}" placeholder="Entrez votre nom">
                                        <span class="ms-2" id="nom_error"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="deux">Prenom <sup class="text-danger">*</sup></label>
                                        <input type="text" name="pnom" id="deux" class="form-control pnom" value="{{ Auth::user()->pnom }}" placeholder="Entrez votre prenom">
                                        <span class="ms-2" id="pnom_error"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="trois">Email <sup class="text-danger">*</sup></label>
                                        <input type="email" name="mail" id="trois" class="form-control mail" value="{{ Auth::user()->email }}" placeholder="Entrez votre mail">
                                        <span class="ms-2" id="mail_error"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="qt">Numero de telephone <sup class="text-danger">*</sup></label>
                                        <input type="text" name="tel" id="qt" class="form-control tel" value="{{ Auth::user()->tel }}" placeholder="Entrez votre numero">
                                        <span class="ms-2" id="tel_error"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="cq">Adresse 1 <sup class="text-danger">*</sup></label>
                                        <input type="text" name="adrss1" id="cq" class="form-control adrss1" value="{{ Auth::user()->adrss1 }}" placeholder="Adresse 1">
                                        <span class="ms-2" id="adrss1_error"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="sx">Adresse 2 <sup class="text-danger">*</sup></label>
                                        <input type="text" name="adrss2" id="sx" class="form-control adrss2" value="{{ Auth::user()->adrss2 }}" placeholder="Adresse 2">
                                        <span class="ms-2" id="adrss2_error"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="st">Ville <sup class="text-danger">*</sup></label>
                                        <input type="text" name="ville" id="st" class="form-control ville" value="{{ Auth::user()->ville }}" placeholder="Entrez votre ville">
                                        <span class="ms-2" id="ville_error"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="ht">Quartier <sup class="text-danger">*</sup></label>
                                        <input type="text" name="quartier" id="ht" class="form-control quartier" value="{{ Auth::user()->quartier }}" placeholder="Entrez votre quartier">
                                        <span class="ms-2" id="quartier_error"></span>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="nf">Code Pin <sup class="text-danger">*</sup></label>
                                        <input type="text" name="codepin" id="nf" class="form-control zip" value="{{ Auth::user()->codepin }}" placeholder="Entrez le code pin">
                                        <span class="ms-2" id="zip_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h5>Autre detail</h5>
                                <hr>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Quantité</th>
                                            <th>P.Unitaire</th>
                                            <th>P.Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($itempanier as $item)
                                        <tr>
                                            <td class="text-capitalize">{{$item -> materiels -> tag }}</td>
                                            <td>{{$item -> qte_mat }}</td>
                                            <td>{{$item -> materiels -> prixreduit_mat }}</td>
                                            <td>{{$item -> materiels -> prixreduit_mat*$item -> qte_mat }} XOF</td>
                                        </tr>
                                        @php $total += $item -> materiels -> prixreduit_mat * $item -> qte_mat; @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <span class="fs-5">Total : <span class="float-end border p-1 border-primary">{{$total}} XOF</span> </span> <br>
                                <button type="button" class="btn btn-primary w-100 mt-2 normal_btn">Paiement à la livraison</button>
                                <button type="button" class="btn btn-success w-100 mt-2" data-bs-toggle="modal" data-bs-target="#domicileModal">Livraison à domicile (+1000 XOF)</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="modal fade" id="domicileModal" tabindex="-1" aria-labelledby="domicileModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="domicileModalLabel">Livraison à domicile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span class="fs-5">Total matériels : <span class="float-end border p-1 border-primary rounded">{{$total}} XOF</span> </span> <br> <br>
                            <span class="fs-5">Frais de livraison : <span class="float-end border p-1 border-primary rounded">1000 XOF</span> </span> <br> <br>
                            @php $total_plivr = $total + 1000 @endphp
                            <h4 class=" d-flex justify-content-center">Total : {{ $total_plivr }} XOF </h4> 
                            <h4 class="d-flex justify-content-center"><button type="button" class="btn btn-success w-75 mt-2 text-uppercase livraison_btn" data-bs-toggle="modal" data-bs-target="#domicileModal">confirmé</button></h4>
                        </div>
                    </div>
                </div>
            </div>
            
        @else
            <div class="container pb-5 mb-5">
                <div class="card py-3 mb-5 border-0 bg-light">
                    <div class=" text-center"><i class="fa-solid fa-check text-success" style="font-size: 9.5em"></i></div>
                    <div class="text-center fs-2">Commande effectué avec succès</div>
                    <div class="text-center fs-2 mt-5">
                        <a class="btn btn-success p-2 fs-4 text-white" href="{{ route('accueil') }}">
                            Poursuivres mes achats
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('scripts')
    
@endsection
