@extends('layouts.front')

@section('title')
    Suivie {{ Auth::user()->name }} {{ Auth::user()->pnom }}
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <div class="fs-4 text-center">Suivie de la commande <span class="float-end"><a href="{{url('/mes-commandes')}} " class="btn btn-outline-dark">Retour</a></span></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($cmd->domicile)
                                <div class="col-md-12 h5 text-danger">
                                    Livraison à domicile
                                </div>
                            @endif
                            <div class="col-md-5 fs-5 mb-4">
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
                            <div class="col-md-7 fs-6 mt-4">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Nom produit</th>
                                            <th>Quantité</th>
                                            <th>Prix unitaire</th>
                                            <th>Prix total</th>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-11 fs-4">Total <span class="border float-end p-1">{{$cmd->total}} XOF</span></div>
                                    @if($cmd -> statut == 0)
                                        <div class="col-md-12 fs-4 text-center text-secondary pt-3"><i class="fa-solid fa-motorcycle"></i> En cours...</div>
                                        <div class="text-center text-secondary"><i class="fa-solid fa-plus"></i> Livraison prevue sous 24h </div>
                                    @endif
                                    @if($cmd -> statut == 1)
                                        <div class="col-md-12 fs-4 text-center text-success pt-3"><i class="fa-solid fa-badge-check"></i> Livrée</div>
                                    @endif
                                    @if($cmd -> statut == 2)
                                        <div class="col-md-12 fs-4 text-center text-danger pt-3"><i class="fa-solid fa-xmark"></i> Annulée</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
