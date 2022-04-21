@extends('layouts.admin')

@section('title', 'Ajout d\'un vendeur')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Ajout d'un vendeur</h3>
        </div>
        <div class="card-body">
            @if ($errors -> any())
                @foreach ($errors->All() as $error )
                    <div class="container text-danger text-center">{{$error}}</div>
                @endforeach
                <hr>
            @endif
            <form action="{{url('insert-vendeur')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="pnom">Prénoms</label>
                        <input type="text" class="form-control" id="pnom" name="pnoms">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="tel">Numero de telephone</label>
                        <input type="text" class="form-control" id="tel" name="tel">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="adrss">Adresse Boutique</label>
                        <input type="text" class="form-control" id="adrss" name="adrss">
                    </div>
                    <div class="col-md-12 text-center mb-3">
                        <button type="submit" class="btn btn-primary">Ajouté</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection