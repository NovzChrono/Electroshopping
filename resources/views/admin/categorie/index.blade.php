@extends('layouts.admin')

@section('title')
    Categories
@endsection
@section('content')
    <div class="card">
        <div class="card-header h3">
            <div class="row">
                <div class="col-md-9">Categories Materiels</div>
                <div class="col-md-3">
                    <a href="{{ url('ajout-categorie') }}" class="btn btn-primary">Ajout de categorie</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td >Id</td>
                        <td >Libellé</td>
                        <td >Image</td>
                        <td >Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorie as $item )
                        <tr>
                            <td>{{$item -> id}}</td>
                            <td>{{$item -> libelleCatMat}}</td>
                            <td>
                                <img class="card-img-top categorie-img" src="{{asset('assets/uploads/categorie/'.$item -> imageCatMat)}}" alt="{{$item -> id}}">
                            </td>
                            <td>
                                <a href="{{url('edit-categorie/'. $item -> id)}}" class="btn btn-primary text-white">Edité</a>
                                <a href="{{url('destroy-categorie/'. $item -> id )}}"class="button btn btn-danger text-white">Supprimé</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
