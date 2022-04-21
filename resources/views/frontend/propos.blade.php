@extends('layouts.front')

@section('title', 'A propos de nous')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('assets/logo.png') }}" alt="logo_digicom" class="img-fluid">
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col md-12 text-center h2"><i>Formation - Service - Innovation</i></div>
                </div>
            </div>
            <hr>
            <div class="col-md-8 pt-5">
                <div class="row">
                    <div class="col md-12 text-center h2"><i>E-Commerce</i></div>
                </div>
            </div>
            <div class="col-md-4 pt-5">
                <img src="{{ asset('assets/logoe.png') }}" alt="logo_electroshp" class="img-fluid">
            </div>
        </div>
    </div>
@endsection