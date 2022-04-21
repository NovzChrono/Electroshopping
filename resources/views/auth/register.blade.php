@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded border-0" style="opacity: 95%">
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex ">
                            <div class="row py-5">
                                <div class="col-md-12">
                                    <div class=" pb-3 text-center text-capitalize fs-3" style="color:rgb(255, 145, 0)">{{ __('Pas encore membre?') }}</div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <div class="ps-2 pe-2">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf

                                            <div class="row mb-3">
                                                <div class="col-md-6">

                                                    <label for="pnom" class="">{{ __('Prénom') }}</label>

                                                    <input id="pnom" type="text" class="form-control @error('pnom') is-invalid @enderror" name="pnom" value="{{ old('pnom') }}" required autocomplete="pnom" autofocus>

                                                    @error('pnom')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">

                                                    <label for="name" class="">{{ __('Nom') }}</label>

                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="">{{ __('E-mail') }}</label>

                                                <div class="col-md-12">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                
                                                <div class="col-md-12">
                                                    <label for="password" class="">{{ __('Mot de passe') }}</label>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-12">

                                                    <label for="password-confirm" class="">{{ __('Mot de passe de confirmation') }}</label>

                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                
                                                </div>
                                            </div>

                                            <div class="row mb-0">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn text-white ps-3 pe-3" style="background-color: rgb(255, 145, 0)">
                                                        {{ __('S\'inscrire') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 py-5" style="background: linear-gradient(rgb(1, 55, 65),rgba(179, 168, 105, 0.555))">
                        <div class="text-center pt-2"><img src="{{ asset('assets/annonce/logo2.png') }}" height="140" alt=""></div>
                        <div class="text-center h4 text-white mb-3">Bienvenue!</div>
                        <div class="text-center text-white fs-5 mb-3">Connectez-vous pour vos achats et plus!</div>
                        <div class="text-center">
                            @if (Route::has('login'))
                                <a class="btn fs-5 text-white border-2 border-white" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
