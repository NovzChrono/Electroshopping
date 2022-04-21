@extends('layouts.admin')

@section('title')
    Utilisateurs n° {{$user->id}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10"><h3 class="pt-2">Utilisateur</h3></div>
                            <div class="col-md-2 pt-3"><a href="{{url('users')}}" class="btn btn-success">Retour</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 fs-5">
                                <label for="" class="mt-2">Nom et Prenom</label>
                                <div class="border p-1">{{$user->name}} {{$user->pnom}}</div>
                                <label for="" class="mt-2">Contact</label>
                                <div class="border p-1">{{$user->tel}}</div>
                                <label for="" class="mt-2">E-mail</label>
                                <div class="border p-1">{{$user->email}}</div>
                                <label for="" class="mt-2">Information sur l'adresse</label>
                                <div class="border p-1">
                                    {{$user->ville}}, {{$user->quartier}}, {{$user->adrss1}}, {{$user->adrss2}}.
                                </div>
                                <label for="" class="mt-2">Code Zip</label>
                                <div class="border p-1">{{$user->codepin}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
