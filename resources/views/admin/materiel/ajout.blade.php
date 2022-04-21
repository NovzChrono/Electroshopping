@extends('layouts.admin')

@section('title')
    Ajout de materiel
@endsection

@section('content')
    @if ($errors -> any())
        @foreach ($errors->All() as $error )
            <div class="container text-danger">{{$error}}</div>
        @endforeach
    @endif
    <div class="card">
        <div class="card-header">
            <h3>Ajout d'un materiele</h3>
        </div>
        <div class="card-body">
            <form action="{{url('insert-materiel')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tag">Tag</label>
                        <input type="text" class="form-control" id="tag" name="tag">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label  for="m">Marque</label><br>
                        <select class="form-select w-100" name="marque" id="m">
                            @foreach ($marques as $item)
                                <option value="{{$item -> id}}">{{$item -> nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label  for="nomv">Vendeur</label><br>
                        <select class="form-select w-100" name="nomv" id="nomv">
                            @foreach ($vendeurs as $item)
                                <option value="{{$item -> id}}">{{$item -> nom .' '. $item -> pnoms . ' (' . $item -> tel . ')'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="descrip">Description</label>
                        <textarea class="form-control" name="description" id="descrip" rows="2"></textarea>
                    </div>
                    <div class="col-md-12 mb-5">
                        <label for="gdescrip">Grand description</label>
                        <textarea class="form-control" name="gdescription" id="gdescrip" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pn">Prix normal</label>
                        <input type="number" class="form-control" id="pn" name="prixn">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pr">Prix reduit</label>
                        <input type="number" class="form-control" id="pr" name="prixr">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="qte">Quantité</label>
                        <input type="number" class="form-control" id="qte" name="qte">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Taxe</label>
                        <input type="number" class="form-control" id="slug" name="taxe">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="statut">Statut</label>
                        <input type="checkbox" id="statut" name="statut">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popu">Tendance</label>
                        <input type="checkbox" id="popu" name="popular">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label  for="matet">Categorie de materiel</label>
                        <select class="form-select w-75" name="fk_cm" id="matet">
                            @foreach ($categorie as $item)
                                <option value="{{$item -> id}}">{{$item -> libelleCatMat}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-4 ">
                        <label for="img">Image</label>
                        <input type="file" class="form-control" id="img" name="image">
                    </div>
                    <div class="col-md-12 mb-4 ">
                        <label for="img2">Image 2</label>
                        <input type="file" class="form-control" id="img2" name="image2">
                    </div>
                    <div class="col-md-12 mb-4 ">
                        <label for="img3">Image 3</label>
                        <input type="file" class="form-control" id="img3" name="image3">
                    </div>
                    <div class="col-md-12 text-center mb-3">
                        <button type="submit" class="btn btn-primary">Envoyez</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
