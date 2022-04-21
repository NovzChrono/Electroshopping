@extends('layouts.front')

@section('title', 'Contactez nous')

@section('content')
    <div class="py-3" >
        <div class="container">
            <div class="mb-0 fs-6 text-dark">
                <a class="text-dark" href="{{ route('accueil')}}">Acceuil</a> > Contactez nous
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="col-md-8">
            <form action="{{ url('/ok') }}" method="post">
                @csrf
                <label class="mt-3" for="a">Nom <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" name="nom" id="a">
                <label class="mt-3" for="b">Numéro <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" name="tel" id="b">
                <label class="mt-3" for="c">Mail <sup class="text-danger">*</sup></label>
                <input type="email" class="form-control" name="mail" id="c">
                <label class="mt-3" for="d">Objet <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" name="objet" id="d">
                <label class="mt-3" for="e">Message <sup class="text-danger">*</sup></label>
                <textarea name="message" id="" class="form-control" rows="7"></textarea>
                <center><input type="submit" value="Envoyer" class="btn btn-secondary fs-5 mt-3 mb-5"></center>
            </form>
        </div>
    </div>
@endsection