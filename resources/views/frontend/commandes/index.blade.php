@extends('layouts.front')

@section('title')
    Mes commandes
@endsection

@section('content')
    @if($commandes -> count() > 0)
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="fs-4 ps-5">Mes Commandes</div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date commande</th>
                                        <th>Numero de suivie</th>
                                        <th>Prix Total</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($commandes as $cmd)
                                        <tr>
                                            <td>{{ date('d - m - Y', strtotime($cmd -> created_at)) }}</td>
                                            <td class="pt-3">{{ $cmd -> suivie_nb }}</td>
                                            <td class="pt-3">{{ $cmd -> total }} XOF</td>
                                            @if($cmd -> statut == 0)
                                                <td class="pt-3">En attente...</td>
                                            @else
                                                <td class="pt-3">{{ $cmd -> statut == 1 ? 'Livrée' : 'Annulée' }}</td>
                                            @endif
                                            @if($cmd -> statut == 0)
                                                <td>
                                                    <a href="{{url('/suivre-commande/' . $cmd -> id )}}" class="btn btn-outline-dark w-100">Suivre la commande</a>
                                                </td>
                                            @else
                                                <td>
                                                    <a href="{{url('/suivre-commande/' . $cmd -> id )}}" class="btn btn-outline-{{ $cmd -> statut == 1 ? 'success' : 'danger' }} w-100">Voir la commande</a>
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
    @else
        <div class="container py-5">
            <div class="card bg-light border-0">
                <div class="py-3 text-center" ><img class="card-img opacity-25 w-25" src="{{asset('assets/xMark.png')}}" alt="xMark"></div>
                <div class="container py-5 text-uppercase text-center text-danger opacity-50 fs-5">Vous n'avez pas effectué de commandes</div>
            </div>
        </div>
    @endif

@endsection
