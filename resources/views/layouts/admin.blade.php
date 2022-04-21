<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/annonce/logo2.png') }}">

    <title>@yield('title')</title>

    <link href="{{ asset('css/admin/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin/nucleo-svg.css') }}" rel="stylesheet" />
    {{--jQuery--}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    {{--Font awesome--}}
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <link href="{{ asset('css/admin/material-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/admin.style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="wrapper">
        @include('layouts.inc.sidebar')

        <div class="main-panel">

            @include('layouts.inc.adminnav')

            <div class="content">
                @yield('content')
            </div>

            @include('layouts.inc.adminfooter')

        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/admin/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/admin/popper.min.js') }}" ></script>
    <script src="{{ asset('js/admin/bootstrap-material-design.min.js') }}" ></script>
    <script src="{{ asset('js/admin/chartjs.min.js') }}"></script>
    <script src="https://unpkg.com/default-passive-events" ></script>
    <script src="{{ asset('js/admin/perfect-scrollbar.jquery.min.js') }}" ></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" ></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/admin/front.js') }}"></script>

    @if (session('status'))
        <script>
            swal({
                    text: "{{ session('status') }}",
                    icon: "success",
                    button: "ok",
                });
        </script>
    @endif
    @if (session('echec'))
        <script>
            swal({
                    text: "{{ session('echec') }}",
                    icon: "error",
                    button: "ok",
                });
        </script>
    @endif
    <script>
        //AutoComplet search suivie
        var available = [];
        $.ajax({
            method: "GET",
            url: "/list-commande",
            data: {

            },
            success: function(response) {
                autoComplete(response)
            }
        });
        function autoComplete(available){
            $("#numero_suivie").autocomplete({
                source: available
            });
        }

    </script>
    <script>
        var availabl = [];
        $.ajax({
            method: "GET",
            url: "/list-numero",
            data: {

            },
            success: function(response) {
                autoComplet(response)
            }
        });
        function autoComplet(availabl){
            $("#numero_tel").autocomplete({
                source: availabl
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
