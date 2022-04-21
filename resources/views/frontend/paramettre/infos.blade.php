@extends('layouts.front')

@section('title', 'Mes informations')

@section('content')
    <div class="container py-5">
        <div class="card border-primary">
            <div class="card-header">
                <i class="fa fa-user text-primary fa-2x"></i> <span class="text-primary">Mes informations personnels</span>
            </div>
            <div class="card-body">
                <form action="{{ url('/modif-infos') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" value="{{ Auth::user()->name }}" id="nom" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pnom">Prenoms :</label>
                            <input type="text" name="pnom" value="{{ Auth::user()->pnom }}" id="pnom" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mail">E-mail :</label>
                            <input type="text" name="mail" value="{{ Auth::user()->email }}" id="mail" class="form-control" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tel">Contact :</label>
                            <input type="text" name="tel" value="{{ Auth::user()->tel }}" id="tel" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="adrss1">Adresse 1 :</label>
                            <input type="text" name="adrss1" value="{{ Auth::user()->adrss1 }}" id="adrss1" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="adrss2">Adresse 2 :</label>
                            <input type="text" name="adrss2" value="{{ Auth::user()->adrss2 }}" id="adrss2" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ville">Ville :</label>
                            <input type="text" name="ville" value="{{ Auth::user()->ville }}" id="ville" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="quartier">Quartier :</label>
                            <input type="text" name="quartier" value="{{ Auth::user()->quartier }}" id="quartier" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="codepin">Code pin :</label>
                            <input type="text" name="codepin" value="{{ Auth::user()->codepin }}" id="codepin" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="mdp">Mot de passe de confirmation :</label>
                            <input type="password" name="mdp" id="mdp" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Modifié</button>
                </form>
            </div>
        </div>
        <div class="card mt-3 border-warning">
            <div class="card-header">
                <i class="fa fa-key text-warning fa-2x"></i> <span class="text-warning">Modifié votre mot de passe</span>
            </div>
            <div class="card-body">
                <form action="{{ url('/modif-mdp') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="mdpa">Entrez le mot de passe actuel :</label>
                            <input type="password" name="mdpa" id="mdpa" class="form-control" placeholder="mot de passe actuel">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="mdpn">Entrez le nouveau mot de passe :</label>
                            <input type="password" name="mdpn" id="mdpn" class="form-control" placeholder="nouveau mot de passe">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="mdpc">Confirmez le nouveau mot de passe :</label>
                            <input type="password" name="mdpc" id="mdpc" class="form-control" placeholder="confirmation du mot de passe">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-warning">Enregistré</button>
                </form>
            </div>
        </div>
    </div>
@endsection