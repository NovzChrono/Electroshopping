@extends('layouts.front')

@section('title', 'Résultat non rétrouvé')

@section('content')
    <div class="container-fluid bg-light">
        <div class="container pb-5">
            <div class="py-5">
                <div class="row py-5">
                    <div class="col-md-1"></div>
                    <div class="col-md-4 py-5">
                        <h3><b>Résultat non trouvé</b></h3>
                        <h5>Nous n'avons pas trouvé se que vous cherchez.</h5>
                        <a class="btn btn-outline-primary p-2 text-uppercase" href="{{ route('accueil') }}">Retour à acceuil</a>
                    </div>
                    <div class="col-md-7">
                        <img src="{{ asset('assets/img/error.svg') }}" class="w-75" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection