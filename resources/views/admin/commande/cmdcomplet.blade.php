@extends('layouts.admin')

@section('title')
    Commande n° {{$cmd->id}}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="pt-3">Commande </h4>
                        </div>
                        <div class="col-md-2">
                            <span class="float-end"><a href="{{url('/commandes/complete')}} " class="btn btn-outline-dark">Retour</a></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($cmd->domicile)
                            <div class="col-md-12 h5 text-danger">
                                Cas de livraison à domicile
                            </div>
                        @endif
                        <div class="col-md-4 fs-5 mb-4">
                            <label for="" class="mt-2">Nom et Prenom</label>
                            <div class="border p-1">{{$cmd->nom}} {{$cmd->pnom}}</div>
                            <label for="" class="mt-2">Contact</label>
                            <div class="border p-1">{{$cmd->tel}}</div>
                            <label for="" class="mt-2">E-mail</label>
                            <div class="border p-1">{{$cmd->email}}</div>
                            <label for="" class="mt-2">Information sur l'adresse</label>
                            <div class="border p-1">
                                {{$cmd->ville}}, {{$cmd->quartier}}, {{$cmd->adrss1}}, {{$cmd->adrss2}}.
                            </div>
                            <label for="" class="mt-2">Code Zip</label>
                            <div class="border p-1">{{$cmd->codepin}}</div>
                        </div>
                        <div class="col-md-8 fs-6 mt-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Nom produit</th>
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                        <th>Prix total</th>
                                        <th>Vendeur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td><img width="70px" src="{{ asset('assets/uploads/materiel/' . $item -> materiels -> image_mat) }}" alt=""></td>
                                            <td class="pt-4">{{$item -> materiels -> nom_mat }}</td>
                                            <td class="pt-4">{{$item -> qte }}</td>
                                            <td class="pt-4">{{$item -> materiels -> prixreduit_mat }}</td>
                                            <td class="pt-4">{{$item -> total }}</td>
                                            <td>
                                                {{$item -> materiels -> vendeur -> nom . ' '. $item -> materiels -> vendeur -> pnoms}} <br>
                                                {{$item -> materiels -> vendeur -> tel }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="pt-1">Total </h4>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="border text-center float-end p-1">{{$cmd->total}} XOF</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="pt-1">Statut </h4>
                                </div>
                                <div class="col-md-3">
                                    @if($cmd -> statut == 2)
                                        <h5 class="border border-danger text-center text-danger p-1"> Annulée </h5>
                                    @else
                                        <h5 class="border border-success text-center text-success p-1"> {{$cmd->statut == '1' ? 'Complète' : 'En attente'}}</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
