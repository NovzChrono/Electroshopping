<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    <link rel="icon" type="image/png" href="{{ asset('assets/annonce/logo2.png') }}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    {{--Font awesome--}}
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />

    
    {{--Bootstrap--}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    {{--jQuery--}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    {{--Mon propre css--}}

    {{--Owl carousel--}}
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css')}}">

    {{--Google awesome--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap" rel="stylesheet">

</head>

<body class=" bg-light">

        @include('layouts.inc.frontnav')

        <div class="container-fluid p-0">

            @yield('content')

        </div>

        @include('layouts.inc.frontfooter')



    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/mediumzoom.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/verifier.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="{{ asset('js/front.js')}}"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/62278faca34c2456412a13e2/1ftl8if1f';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();

    <!--End of Tawk.to Script-->
    </script>
    @if (session('status'))
        <script>
            
             swal({
                    text: "{{ session('status') }}",
                    icon: 'success',
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
    @yield('scripts')
</body>
</html>
