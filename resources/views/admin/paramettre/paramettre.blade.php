@extends('layouts.admin')

@section('title', 'Paramettre')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="text-center text-uppercase fs-4">MES INFORMATIONS PERSONNELS</h4>
            </div>
            <div class="card-body">
                @if ($errors -> any())
                    @foreach ($errors->All() as $error )
                        <div class="container text-danger text-center">{{$error}}</div>
                    @endforeach
                    <hr>
                @endif
                <form action="{{ url('modif_info_admin') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="un">Nom <sup class="text-danger">*</sup> </label>
                            <input type="text" name="nom" id="un" class="form-control nom" value="{{ Auth::user()->name }}" placeholder="Entrez votre nom">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="deux">Prenom <sup class="text-danger">*</sup></label>
                            <input type="text" name="pnom" id="deux" class="form-control pnom" value="{{ Auth::user()->pnom }}" placeholder="Entrez votre prenom">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="trois">Email <sup class="text-danger">*</sup></label>
                            <input disabled type="email" name="mail" id="trois" class="form-control mail" value="{{ Auth::user()->email }}" placeholder="Entrez votre mail">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="qt">Numero de telephone <sup class="text-danger">*</sup></label>
                            <input type="text" name="tel" id="qt" class="form-control tel" value="{{ Auth::user()->tel }}" placeholder="Entrez votre numero">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="cq">Adresse 1 <sup class="text-danger">*</sup></label>
                            <input type="text" name="adrss1" id="cq" class="form-control adrss1" value="{{ Auth::user()->adrss1 }}" placeholder="Adresse 1">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="sx">Adresse 2 <sup class="text-danger">*</sup></label>
                            <input type="text" name="adrss2" id="sx" class="form-control adrss2" value="{{ Auth::user()->adrss2 }}" placeholder="Adresse 2">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="st">Ville <sup class="text-danger">*</sup></label>
                            <input type="text" name="ville" id="st" class="form-control ville" value="{{ Auth::user()->ville }}" placeholder="Entrez votre ville">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="ht">Quartier <sup class="text-danger">*</sup></label>
                            <input type="text" name="quartier" id="ht" class="form-control quartier" value="{{ Auth::user()->quartier }}" placeholder="Entrez votre quartier">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="nf">Code Pin <sup class="text-danger">*</sup></label>
                            <input type="text" name="codepin" id="nf" class="form-control zip" value="{{ Auth::user()->codepin }}" placeholder="Entrez le code pin">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="md">Confirmez avec le mot de passe <sup class="text-danger">*</sup></label>
                            <input type="password" name="mdp" id="md" class="form-control zip" placeholder="Entrez votre mot de passe">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <span class="float-end"><button type="submit" class="btn btn-primary">Enregistré</button></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
