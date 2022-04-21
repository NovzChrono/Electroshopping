<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/annonce/logo2.png') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <title>Facture n° {{ $cmd -> id }}</title>
</head>
<body>
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <span class="float-end">Facture n°{{ $cmd -> id }}</span>
                <h6">Nom : <span class="text-uppercase">{{ $cmd->nom }}</span></h6>
                <h6 class="text-capitalize">Prenom : {{ $cmd->pnom }}</h6>
                <h6>Numero : {{ $cmd->tel }}</h6>
                <h6>Mail : {{ $cmd->email }}</h6>
                <h6>Adresse 1 : {{ $cmd->adrss1 }}</h6>
                <h6>Adresse 2 : {{ $cmd->adrss2 }}</h6>
                <hr>
                <h6>Numero de suivie de la commande : {{ $cmd->suivie_nb }}</h6>
                @if($cmd -> domicile)
                    <h6 class="text-secondary"><i class="fa-solid fa-motorcycle"></i> Livraison à domicile</h6>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Prix Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items_cmd as $item)
                            <tr>
                                <td><img width="50px" src="{{ asset('assets/uploads/materiel/'.$item-> materiels -> image_mat ) }}" alt=""></td>
                                <td>{{ $item-> materiels -> nom_mat}}</td>
                                <td>{{ $item-> qte }}</td>
                                <td>{{ $item-> materiels -> prixreduit_mat}}</td>
                                <td>{{ $item-> total }}</td>
                            </tr>
                        @endforeach
                        @if($cmd -> domicile)
                            <tr>
                                <td></td>
                                <td>La livraison</td>
                                <td></td>
                                <td></td>
                                <td>{{ $cmd->domicile }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="text-end py-5 h4">
                    <span>Total {{ $cmd-> domicile == 0 ? '' : 'materiels' }} : <span class="border p-2 ms-2">{{ $cmd -> total }}F CFA</span></span>
                    @if($cmd -> domicile)
                        <span class="ms-5">Total : <span class="border p-2 ms-2">{{ $cmd -> total + $cmd -> domicile }}F CFA</span></span></div>
                    @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
