@extends('layouts.admin')

@section('title', 'Modifié votre mot de passe')

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
                <form action="{{ url('modif_pwd_admin') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <label for="un">Entrez le mot de pass actuel <sup class="text-danger">*</sup> </label>
                            <input type="password" name="mdpa" id="un" class="form-control" placeholder=" Mot de passe actuel">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="nf">Entrez le nouveau mot de passe <sup class="text-danger">*</sup></label>
                            <input type="password" name="mdpn" id="nf" class="form-control"" placeholder="Nouveau mot de passe">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="nf">Confirmez le nouveau mot de passe <sup class="text-danger">*</sup></label>
                            <input type="password" name="mdpc" id="nf" class="form-control"" placeholder="Confirmation du nouveau mot de passe">
                        </div>
                        <div class="card-footer text-center">
                        <span class="float-end"><button type="submit" class="btn btn-primary">Modifié</button></span>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
