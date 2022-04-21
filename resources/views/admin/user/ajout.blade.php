@extends('layouts.admin')

@section('title','Ajout d\'un employé')

@section('content')
    
    <div class="card">
        <div class="card-header">
            <h3>Ajout d'un employé</h3>
        </div>
        <div class="card-body">
            @if ($errors -> any())
                @foreach ($errors->All() as $error )
                    <div class="container text-danger text-center">{{$error}}</div>
                @endforeach
                <hr>
            @endif
            <form action="{{url('insert-employe')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pnom">Prénoms</label>
                        <input type="text" class="form-control" id="pnom" name="pnoms">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" class="form-control" id="mdp" name="mdp">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cmdp">Confirmation du mot de passe</label>
                        <input type="password" class="form-control" id="cmdp" name="cmdp">
                    </div>
                    <div class="col-md-12 text-center mb-3">
                        <button type="submit" class="btn btn-primary">Ajouté</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection