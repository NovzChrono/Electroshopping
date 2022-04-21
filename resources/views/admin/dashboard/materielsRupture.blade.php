@extends('layouts.admin')

@section('title')
    Materiels
@endsection

@section('content')
    <div class="card">
        <div class="card-header h3">
            <div class="row">
                <div class="col-md-9">Materiels presque en rupture de stock</div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td >Id</td>
                        <td >Categorie</td>
                        <td >Nom</td>
                        <td >Prix réduit</td>
                        <td class="text-danger"> Quantité</td>
                        <td >Image</td>
                        <td >Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materiel as $article )
                        <tr>
                            <td>{{$article -> id}}</td>
                            <td>{{$article -> categorie_materiel -> libelleCatMat}}</td>
                            <td>{{$article -> nom_mat}}</td>
                            <td>{{$article -> prixreduit_mat}}</td>
                            <td class="text-danger"> {{ $article -> qte_mat }}</td>
                            <td>
                                <img class="card-img-top categorie-img" src="{{asset('assets/uploads/materiel/'.$article -> image_mat)}}" alt="{{$article -> id}}">
                            </td>
                            <td>
                                <a href="{{url('edit-materiel/'. $article -> id)}}" class="btn btn-primary text-white">Edité</a>
                                <a href="{{url('destroy-materiel/'. $article -> id )}}"class="button btn btn-danger text-white">Supprimé</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
