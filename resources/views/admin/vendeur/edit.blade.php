@extends('layouts.admin')

@section('title', 'Modification des données d\'un vendeur')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Modification</h3>
        </div>
        <div class="card-body">
            @if ($errors -> any())
                @foreach ($errors->All() as $error )
                    <div class="container text-danger text-center">{{$error}}</div>
                @endforeach
                <hr>
            @endif
            <form action="{{url('update-vendeur/'. $vendeur->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" value="{{ $vendeur->nom }}" id="nom" name="nom">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="pnom">Prénoms</label>
                        <input type="text" class="form-control" value="{{ $vendeur->pnoms }}" id="pnom" name="pnoms">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="tel">Numero de telephone</label>
                        <input type="text" class="form-control" value="{{ $vendeur->tel }}" id="tel" name="tel">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="adrss">Adresse Boutique</label>
                        <input type="text" class="form-control" value="{{ $vendeur->adrss }}" id="adrss" name="adrss">
                    </div>
                    <div class="col-md-12 text-center mb-3">
                        <button type="submit" class="btn btn-primary">Ajouté</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection