@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ url('cmd_day') }}">
                    <div class="card bg-success">
                        <div class="card-header p-3 pt-2">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Commandes faites aujourd'hui</h5>
                                    <h2 class="">{{ $cmd }}</h2>
                                </div>
                                <div class="col-md-3 py-5">
                                    <i class="large material-icons md-36">add_shopping_cart</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ url('user_day') }}">
                    <div class="card bg-danger">
                        <div class="card-header p-3 pt-2">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Personnes inscrite aujourd'hui</h5>
                                    <h2 class="">{{ $user }}</h2>
                                </div>
                                <div class="col-md-3 py-5">
                                    <i class="large material-icons md-36">person_add</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ url('cmd_no_complete') }}">
                    <div class="card bg-dark">
                        <div class="card-header p-3 pt-2">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Commande pas encore complété</h5>
                                    <h2 class="">{{ $cmd_NoCpt }}</h2>
                                </div>
                                <div class="col-md-3 py-5">
                                    <i class="large material-icons md-36">weekend</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ url('cmd_rupture') }}">
                    <div class="card bg-primary">
                        <div class="card-header p-3 pt-2">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Materiel presque en rupture de stock</h5>
                                    <h2 class="">{{ $mat_pres }}</h2>
                                </div>
                                <div class="col-md-3 py-5">
                                    <i class="large material-icons md-36">storage</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <div class="text-center text-uppercase">Nombre de commandes par Jours</div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChartCmd" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <div class="text-center text-uppercase">Nombre de inscrites par Jours</div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChartUser" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        //Commandes par jours
        var _xdata = {!! json_encode($joursCountCmd) !!}
        var _ydata = {!! json_encode($joursCmd) !!}
        var doc = document.getElementById('myChartCmd')
        var mychart = new Chart( doc,{
            type: 'line',
            data: {
                labels: _ydata,
                datasets: [{
                label: 'commmandes',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: _xdata,
                }],
            },
            options: {}
        });

        //Utilisateurs inscript par Jours
        var xdata = {!! json_encode($joursCountUser) !!}
        var ydata = {!! json_encode($joursUser) !!}
        var docu = document.getElementById('myChartUser')
        var mychartUser = new Chart( docu,{
            type: 'line',
            data: {
                labels: ydata,
                datasets: [{
                label: 'utilisateurs',
                backgroundColor: 'rgb(25, 99, 132)',
                borderColor: 'rgb(25, 99, 132)',
                data: xdata,
                }],
            },
            options: {}
        });
    </script>
@endsection
