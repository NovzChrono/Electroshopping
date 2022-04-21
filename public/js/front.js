$(document).ready(function() {

    nbPanier()
    nbFavorie()
        //Notification sur nb dans le panier et dans favoris
    function nbPanier() {
        $.ajax({
            method: "GET",
            url: "/nb-panier-notif",
            success: function(response) {
                $('.panier-count').html('');
                $('.panier-count').html(response.count);
            }
        });
    }

    function nbFavorie() {
        $.ajax({
            method: "GET",
            url: "/nb-favories-notif",
            success: function(response) {
                $('.favories-count').html('');
                $('.favories-count').html(response.count);
            }
        });
    }


    //dans viewmateriel
    $('.ajoutPanierBtn').click(function(e) {
        e.preventDefault();

        let materiel_id = $(this).closest('.materiel-data').find('.mat_id').val();
        let materiel_nb = $(this).closest('.materiel-data').find('.nb-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/ajout-panier",
            data: {
                'materiel_id': materiel_id,
                'materiel_nb': materiel_nb,
            },
            success: function(response) {
                nbPanier()
                swal(response.status);
            }

        });
    });

    $('.ajoutPanier').click(function(e) {
        e.preventDefault();

        let materiel_id = $(this).closest('#materiel_id').find('.mat_id').val();
        let materiel_nb = 1

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/ajout-panier",
            data: {
                'materiel_id': materiel_id,
                'materiel_nb': materiel_nb,
            },
            success: function(response) {
                nbPanier()
                swal(response.status);
            }

        });
    });


    $(document).on('click','.sup-mat-panier', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let mat_id = $(this).closest('.materiel-data').find('.mat_id').val();
        $.ajax({
            method: "POST",
            url: "/sup-mat-panier",
            data: {
                'mat_id': mat_id,
            },
            success: function(response) {
                //window.location.reload();
                nbPanier()
                $('.panier').load(location.href + " .panier")
                swal(response.status)
            }
        });
    });

    //dans favories
    $('.ajoutFavorie').click(function(e) {
        e.preventDefault();

        let materiel_id = $(this).closest('.materiel-data').find('.mat_id').val();
        let materiel_nb = $(this).closest('.materiel-data').find('.nb-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/ajout-favorie",
            data: {
                'materiel_id': materiel_id,
                'materiel_nb': materiel_nb,
            },
            success: function(response) {
                nbFavorie()
                swal(response.status);
            }

        });
    });

    $('.ajout-mat-panier').click(function(e) {
        e.preventDefault();

        let materiel_id = $(this).closest('.materiel-data').find('.mat_id').val();
        let materiel_nb = $(this).closest('.materiel-data').find('.mat_qte').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/ajout-favorie-panier",
            data: {
                'materiel_id': materiel_id,
                'materiel_nb': materiel_nb,
            },
            success: function(response) {
                window.location.reload();
                swal(response.status);
            }

        });
    });

    $(document).on('click','.sup-mat-favorie', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let mat_id = $(this).closest('.materiel-data').find('.mat_id').val();
        $.ajax({
            method: "POST",
            url: "/sup-mat-favorie",
            data: {
                'mat_id': mat_id,
            },
            success: function(response) {
                nbFavorie()
                $('.favorie').load(location.href + " .favorie")
                swal(response.status)
            }
        });
    });


    $(document).on('click','.increment-btn', function(e){
        e.preventDefault();

        let inc_value = $(this).closest('.materiel-data').find('.nb-input').val();
        let value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.materiel-data').find('.nb-input').val(value);
        }
    });

    $(document).on('click','.decrement-btn', function(e){
        e.preventDefault();

        let dec_value = $(this).closest('.materiel-data').find('.nb-input').val();
        let value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.materiel-data').find('.nb-input').val(value);
        }
    });

    $(document).on('click','.changeQte', function(e){
        e.preventDefault();

        let mat_id = $(this).closest('.materiel-data').find('.mat_id').val();
        let qte = $(this).closest('.materiel-data').find('.nb-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/update-panier",
            data: {
                'mat_id': mat_id,
                'mat_qte': qte
            },
            success: function(response) {
                $('.panier').load(location.href + " .panier")
                window.location.reload();
            }
        });
    });

});

//AutoComplet search
var availableTags = [];
$.ajax({
    method: "GET",
    url: "/list-materiel",
    data: {

    },
    success: function(response) {
        autoComplete(response)
    }
});
function autoComplete(availableTags){
    $("#rech_materiel").autocomplete({
        source: availableTags
    });
}

//AutoComplet search
var availableTag = [];
$.ajax({
    method: "GET",
    url: "/list-materiels",
    data: {

    },
    success: function(response) {
        autoComplet(response)
    }
});
function autoComplet(availableTag){
    $("#rech_materiels").autocomplete({
        source: availableTag
    });
}
