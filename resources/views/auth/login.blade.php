@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded border-0 " style="opacity: 95%">
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex ">
                            <div class="row py-5">
                                <div class="col-md-12">
                                    <div class=" pb-5 text-center text-capitalize fs-3" style="color:rgb(255, 145, 0)">{{ __('Connexion espace membre') }}</div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-10 ">
                                    <div class="ps-2 pe-2">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="email" class="">{{ __('E-mail') }}</label>

                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="">{{ __('Mot de passe') }}</label>

                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>

                                            <div class="mb-3 text-start">
                                                <div class="">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="remember">
                                                            {{ __('Rester connecté') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-0">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn text-white ps-2 pe-2" style="background-color: rgb(255, 145, 0)">
                                                        {{ __('Se Connecter') }}
                                                    </button>

                                    
                                                </div>
                                                <div class="col-md-12 mt-3 text-center">
                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link text-black text-decoration-none" href="{{ route('password.request') }}">
                                                            {{ __('Mot de passe oublié ?') }}
                                                        </a>
                                                    @endif
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
                        <div class="text-center h4 text-white mb-3">Pas encore membre?</div>
                        <div class="text-center text-white fs-5 mb-3">Inscrivez vous pour vos achats!</div>
                        <div class="text-center">
                            @if (Route::has('register'))
                                <a class="btn fs-5 text-white border-2 border-white" href="{{ route('register') }}">{{ __('S\'inscrire') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
