@extends('layouts.admin')

    @section('title')
        Modification d'une marque
    @endsection
    @section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edité la marque</h3>
        </div>
        <div class="card-body">
            @if ($errors -> any())
                @foreach ($errors->All() as $error )
                    <div class="container text-danger text-center">{{$error}}</div>
                @endforeach
                <hr>
            @endif
            <form action="{{url('update-marque/' . $search -> id )}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="libelle" value="{{ $search -> nom}}">
                    </div>
                    <div class="col-md-12 mb-4 ">
                        <label for="img">Image</label><br>
                        @if($search -> logo)
                            <img class="categorie-img" src="{{asset('assets/uploads/marque/' . $search-> logo)}}" alt="">
                        @endif
                        <input type="file" class="form-control" id="img" name="image">
                    </div>
                    <div class="col-md-12 text-center mb-3">
                        <button type="submit" class="btn btn-primary">Modifié</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endsection
