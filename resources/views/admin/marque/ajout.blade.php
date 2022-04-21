@extends('layouts.admin')

@section('title')
    Ajout d'une marque
@endsection

@section('content')
    @if ($errors -> any())
    @foreach ($errors->All() as $error )
        <div class="container text-danger">{{$error}}</div>
    @endforeach
    @endif
    <div class="card">
        <div class="card-header">
            <h3>Ajout d'une marque</h3>
        </div>
        <div class="card-body">
            @if ($errors -> any())
                @foreach ($errors->All() as $error )
                    <div class="container text-danger text-center">{{$error}}</div>
                @endforeach
                <hr>
            @endif
            <form action="{{url('insert-marque')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="nom">Nom de la marque</label>
                        <input type="text" class="form-control" id="nom" name="libelle">
                    </div>
                    <div class="col-md-12 mb-4 ">
                        <label for="img">Image</label>
                        <input type="file" class="form-control" id="img" name="image">
                    </div>
                    <div class="col-md-12 text-center mb-3">
                        <button type="submit" class="btn btn-primary">Ajouté</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
