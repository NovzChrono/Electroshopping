@extends('layouts.admin')

@section('title', 'Histoirique de commandes')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9"><h3 class="pt-2">Historique de commandes</h3></div>
                            <div class="col-md-2"><a href="{{url('/commandes')}}" class="btn btn-primary">Commandes en cours</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Date commande</th>
                                    <th>Numero de suivie</th>
                                    <th>Prix Total</th>
                                    <th>Statut</th>
                                    <th>Factures</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commandes as $cmd)
                                    <tr>
                                        <td class="pt-3">{{ $cmd -> id }}</td>
                                        <td class="pt-3">{{ date('d - m - Y', strtotime($cmd -> created_at)) }}</td>
                                        <td class="pt-3">{{ $cmd -> suivie_nb }}</td>
                                        <td class="pt-3">{{ $cmd -> total }} XOF</td>
                                        <td class="pt-3">{{ $cmd -> statut == 1 ? 'Livrée' : 'Annulée' }} </td>
                                        @if($cmd -> statut == 1)
                                            <td><a href="{{ url('facture/'. $cmd -> id) }}" class="btn btn-primary rounded-1 p-2 text-center">Voir</a></td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>
                                            <a href="{{url('commande/complete/' . $cmd -> id )}}" class="btn btn-{{ $cmd -> statut == 1 ? 'success' : 'danger' }}">Voir la commande</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
