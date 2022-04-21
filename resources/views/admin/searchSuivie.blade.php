@extends('layouts.admin')

@section('title')
    {{ $search }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="row">
                            <div class="col-md-9"><h3 class="pt-2">Recherche sur {{ $search }}</h3></div>
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
                                @foreach ($cmds as $cmd)
                                    <tr>
                                        <td class="pt-3">{{ $cmd -> id }}</td>
                                        <td class="pt-3">{{ date('d - m - Y', strtotime($cmd -> created_at)) }}</td>
                                        <td class="pt-3">{{ $cmd -> suivie_nb }}</td>
                                        <td class="pt-3">{{ $cmd -> total }} XOF</td>
                                        @if($cmd -> statut == 2)
                                            <td class="pt-3">Annulée</td>
                                        @else
                                            <td class="pt-3">{{ $cmd -> statut == '0' ? 'En attente' : 'Complète' }} </td>
                                        @endif
                                        @if($cmd -> statut != 2)
                                            <td class="pt-3">
                                                <a href="{{ url('facture/'. $cmd -> id) }}" class="btn btn-primary rounded-1 p-2 text-center">Voir</a>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if($cmd -> statut == 0)
                                            <td class="pt-3">
                                                <a href="{{url('commande/statut/' . $cmd -> id )}}" class="w-100 btn btn-secondary">Suivre la commande</a>
                                            </td>
                                        @else
                                        <td>
                                            <a href="{{url('commande/statut/' . $cmd -> id )}}" class="w-100 btn btn-{{ $cmd -> statut == 1 ? 'success' : 'danger' }}">Voir la commande</a>
                                        </td>
                                        @endif
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
