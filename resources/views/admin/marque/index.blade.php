@extends('layouts.admin')

@section('title', 'Liste des marques')

@section('content')
    <div class="card">
        <div class="card-header h3">
            <div class="row">
                <div class="col-md-9">Marques</div>
                <div class="col-md-3">
                    <a href="{{ url('ajout-marque') }}" class="btn btn-primary">Ajout de marque</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td >Id</td>
                        <td >Nom de la marque</td>
                        <td >Image</td>
                        <td >Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marque as $item )
                        <tr>
                            <td>{{$item -> id}}</td>
                            <td>{{$item -> nom}}</td>
                            <td>
                                <img class="" width="100px" height="100px" src="{{asset('assets/uploads/marque/'.$item -> logo)}}" alt="{{$item -> id}}">
                            </td>
                            <td>
                                <a href="{{url('edit-marque/'. $item -> id)}}" class="btn btn-primary text-white">Edité</a>
                                <a href="{{url('destroy-marque/'. $item -> id )}}"class="button btn btn-danger text-white">Supprimé</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection