@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9"><h3 class="pt-2">Comptes utilisateurs créer aujourd'hui</h3></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom & Prenoms</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="pt-3">{{ $user -> id }}</td>
                                    <td class="pt-3">{{ $user -> name . ' ' . $user -> pnom  }}</td>
                                    <td class="pt-3">{{ $user -> email }}</td>
                                    <td class="pt-3">{{ $user -> tel }}</td>
                                    <td>
                                        <a href="{{url('user/' . $user -> id )}}" class="btn btn-outline-dark">Voir les données</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
