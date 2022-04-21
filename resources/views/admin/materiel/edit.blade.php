@extends('layouts.admin')

    @section('title')
        Modification de materiel
    @endsection

    @section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edité un materiel</h3>
        </div>
        <div class="card-body">
            @if ($errors -> any())
            @foreach ($errors->All() as $error )
                <div class="container text-danger">{{$error}}</div>
            @endforeach
            @endif
            <form action="{{url('update-materiel/' . $search -> id )}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ $search -> nom_mat}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tag">Tag</label>
                        <input type="text" class="form-control" id="tag" name="tag" value="{{ $search -> tag }}">
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="descrip">Description</label>
                        <textarea class="form-control" name="description" id="descrip" rows="2">{{ $search -> description_mat }}</textarea>
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="gdescrip">Grand Description</label>
                        <textarea class="form-control" name="gdescription" id="gdescrip" rows="3">{{ $search -> gdescription_mat }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pn">Prix normal</label>
                        <input type="number" class="form-control" id="pn" name="prixn" value="{{ $search -> prixnormal_mat}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pr">Prix reduit</label>
                        <input type="number" class="form-control" id="pr" name="prixr" value="{{ $search -> prixreduit_mat}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="qte">Quantité</label>
                        <input type="number" class="form-control" id="qte" name="qte" value="{{ $search -> qte_mat}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Taxe</label>
                        <input type="number" class="form-control" id="slug" name="taxe" value="{{ $search -> impot_mat}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="statut">Statut</label>
                        <input type="checkbox" id="statut" name="statut" {{ $search -> statut_mat == '1' ? 'checked' : ''}}>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popu">Tendance</label>
                        <input type="checkbox" id="popu" name="popular" {{ $search -> popular_mat == '1' ? 'checked' : ''}}>
                    </div>
                    <div class="col-md-12 mb-4 ">
                        <label for="img">Image</label><br>
                        @if($search -> image_mat)
                            <img class="categorie-img" src="{{asset('assets/uploads/materiel/' . $search-> image_mat)}}" alt="">
                        @endif
                        <input type="file" class="form-control" id="img" name="image">
                    </div>
                    <div class="col-md-12 mb-4 ">
                        <label for="img2">Image 2</label><br>
                        @if($search -> image2_mat)
                            <img class="categorie-img" src="{{asset('assets/uploads/materiel2/' . $search-> image2_mat)}}" alt="">
                        @endif
                        <input type="file" class="form-control" id="img2" name="image2">
                    </div>
                    <div class="col-md-12 mb-4 ">
                        <label for="img2">Image 3</label><br>
                        @if($search -> image3_mat)
                            <img class="categorie-img" src="{{asset('assets/uploads/materiel3/' . $search-> image3_mat)}}" alt="">
                        @endif
                        <input type="file" class="form-control" id="img3" name="image3">
                    </div>
                    <div class="col-md-12 text-center mb-3">
                        <button type="submit" class="btn btn-primary">Modifié</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endsection
