@extends('layouts.admin')

    @section('title')
        Modification d'une catégorie
    @endsection
    @section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edité un categorie materiel</h3>
        </div>
        <div class="card-body">
            @if ($errors -> any())
                @foreach ($errors->All() as $error )
                    <div class="container text-danger text-center">{{$error}}</div>
                @endforeach
                <hr>
            @endif
            <form action="{{url('update-categorie/' . $search -> id )}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="libelle" value="{{ $search -> libelleCatMat}}">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="descrip">Description</label>
                        <textarea class="form-control" name="description" id="descrip" rows="3">{{ $search -> descriptionCatMat }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="statut">Statut</label>
                        <input type="checkbox" id="statut" name="statut" {{ $search -> statutCatMat == '1' ? 'checked' : ''}}>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popu">Tendance</label>
                        <input type="checkbox" id="popu" name="popular" {{ $search -> popularCatMat == '1' ? 'checked' : ''}}>
                    </div>
                    <div class="col-md-12 mb-4 ">
                        <label for="img">Image</label><br>
                        @if($search -> imageCatMat)
                            <img class="categorie-img" src="{{asset('assets/uploads/categorie/' . $search-> imageCatMat)}}" alt="">
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
