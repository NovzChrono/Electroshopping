@extends('layouts.admin')

@section('title', 'Liste des vendeurs')

@section('content')
    <div class="card">
        <div class="card-header h3">
            <div class="row">
                <div class="col-md-9">Vendeurs</div>
                <div class="col-md-3">
                    <a href="{{ url('ajout-vendeur') }}" class="btn btn-primary">Ajout d'un vendeur'</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td >Id</td>
                        <td >Nom & Prénoms</td>
                        <td >Téléphone</td>
                        <td> Adresse </td>
                        <td> Action </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendeurs as $item )
                        <tr>
                            <td>{{$item -> id}}</td>
                            <td>{{$item -> nom . ' ' . $item -> pnoms}}</td>
                            <td>{{$item -> tel}}</td>
                            <td>{{$item -> adrss}}</td>
                            <td>
                                <a href="{{url('edit-vendeur/'. $item -> id)}}" class="btn btn-primary text-white">Edité</a>
                                <a href="{{url('destroy-vendeur/'. $item -> id )}}"class="button btn btn-danger text-white">Supprimé</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection