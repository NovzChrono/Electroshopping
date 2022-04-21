<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/annonce/logo2.png') }}">

    <title>Accueil</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />


    <!-- Styles -->
</head>
<body style="background-image:url('{{ asset('assets/img/back1.jpg') }}')">
    <div id="app">
        <div class="container-fluid position-absolute pt-2">
            <a class="navbar-brand btn text-white" style="background: rgba(1, 64, 75, 0.644)" href="{{ url('/') }}">
                <i class="fa-solid fa-arrow-left-long me-1"></i>Acceuil
            </a>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('echec'))
        <script>
             swal({
                    text: "{{ session('echec') }}",
                    button: "ok",
                });
        </script>
    @endif
</body>
</html>
