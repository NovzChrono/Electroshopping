@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded border-0 pb-5" style="opacity: 95%">
                <div class="fs-6 ms-3 mt-1">
                    @if (Route::has('register'))
                        <a class="fs-6 text-decoration-underline text-dark" href="{{ route('login') }}">{{ __('Retour') }}</a>
                    @endif
                </div>
                <div class="card-header bg-white border-0 text-center pt-5 fs-3" style="color:rgb(255, 145, 0)">{{ __('Mot de passe oublié') }}</div>
                    
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email" class="">{{ __('Adresse Email') }}</label>

                                    <div class="">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <div class="text-center">
                                        <button type="submit" class="btn fs-5 ps-2 pe-2 mt-3 text-white" style="background-color: rgb(255, 145, 0)">
                                            {{ __('Envoyez') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
