
$(document).ready(function() {
    $(document).on('click','.normal_btn', function(e){
        e.preventDefault();
        let nom = $('.nomu').val()
        let pnom = $('.pnom').val()
        let mail = $('.mail').val()
        let tel = $('.tel').val()
        let adrss1 = $('.adrss1').val()
        let adrss2 = $('.adrss2').val()
        let ville = $('.ville').val()
        let quartier = $('.quartier').val()
        let zip = $('.zip').val()

        if (!nom) {
            nom_error = '<i class="fa fa-circle-exclamation text-danger"></i> Nom obligatorie'
            $('#nom_error').html()
            $('#nom_error').html(nom_error)
        } else {
            nom_error = ''
            $('#nom_error').html()
        }
        if (!pnom) {
            pnom_error = '<i class="fa fa-circle-exclamation text-danger"></i> Prenom obligatorie'
            $('#pnom_error').html()
            $('#pnom_error').html(pnom_error)
        } else {
            pnom_error = ''
            $('#pnom_error').html()
        }
        if (!mail) {
            mail_error = '<i class="fa fa-circle-exclamation text-danger"></i> Mail obligatorie'
            $('#mail_error').html()
            $('#mail_error').html(mail_error)
        } else {
            mail_error = ''
            $('#mail_error').html()
        }
        if (!tel) {
            tel_error = '<i class="fa fa-circle-exclamation text-danger"></i> Numero obligatorie'
            $('#tel_error').html()
            $('#tel_error').html(tel_error)
        } else {
            tel_error = ''
            $('#tel_error').html()
        }
        if (!adrss1) {
            adrss1_error = '<i class="fa fa-circle-exclamation text-danger"></i> Adresse obligatorie'
            $('#adrss1_error').html()
            $('#adrss1_error').html(adrss1_error)
        } else {
            adrss1_error = ''
            $('#adrss1_error').html()
        }
        if (!adrss2) {
            adrss2_error = '<i class="fa fa-circle-exclamation text-danger"></i> Adresse obligatorie'
            $('#adrss2_error').html()
            $('#adrss2_error').html(adrss2_error)
        } else {
            adrss2_error = ''
            $('#adrss2_error').html()
        }
        if (!ville) {
            ville_error = '<i class="fa fa-circle-exclamation text-danger"></i> Ville obligatorie'
            $('#ville_error').html()
            $('#ville_error').html(ville_error)
        } else {
            ville_error = ''
            $('#ville_error').html()
        }
        if (!quartier) {
            quartier_error = '<i class="fa fa-circle-exclamation text-danger"></i> Quartier obligatorie'
            $('#quartier_error').html()
            $('#quartier_error').html(quartier_error)
        } else {
            quartier_error = ''
            $('#quartier_error').html()
        }
        if (!zip) {
            zip_error = '<i class="fa fa-circle-exclamation text-danger"></i> Code Zip obligatorie'
            $('#zip_error').html()
            $('#zip_error').html(zip_error)
        } else {
            zip_error = ''
            $('#zip_error').html()
        }

        if (nom_error != '' || pnom_error != '' || mail_error != '' || tel_error != '' || adrss1_error != '' || adrss2_error != '' || ville_error != '' || quartier_error != '' || zip_error != '') {
            return false
        } else {
            var data = {
                'nom': nom,
                'pnom': pnom,
                'mail': mail,
                'tel': tel,
                'adrss1': adrss1,
                'adrss2': adrss2,
                'ville': ville,
                'quartier': quartier,
                'zip': zip
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/cmd-place",
                data: data,
                success: function(response) {
                    $('.verifie').load(location.href + " .verifie")
                    swal(response.status);

                }
            });
        }
    });
    $(document).on('click','.livraison_btn', function(e){
        e.preventDefault();
        let nom = $('.nomu').val()
        let pnom = $('.pnom').val()
        let mail = $('.mail').val()
        let tel = $('.tel').val()
        let adrss1 = $('.adrss1').val()
        let adrss2 = $('.adrss2').val()
        let ville = $('.ville').val()
        let quartier = $('.quartier').val()
        let zip = $('.zip').val()

        if (!nom) {
            nom_error = '<i class="fa fa-circle-exclamation text-danger"></i> Nom obligatorie'
            $('#nom_error').html()
            $('#nom_error').html(nom_error)
        } else {
            nom_error = ''
            $('#nom_error').html()
        }
        if (!pnom) {
            pnom_error = '<i class="fa fa-circle-exclamation text-danger"></i> Prenom obligatorie'
            $('#pnom_error').html()
            $('#pnom_error').html(pnom_error)
        } else {
            pnom_error = ''
            $('#pnom_error').html()
        }
        if (!mail) {
            mail_error = '<i class="fa fa-circle-exclamation text-danger"></i> Mail obligatorie'
            $('#mail_error').html()
            $('#mail_error').html(mail_error)
        } else {
            mail_error = ''
            $('#mail_error').html()
        }
        if (!tel) {
            tel_error = '<i class="fa fa-circle-exclamation text-danger"></i> Numero obligatorie'
            $('#tel_error').html()
            $('#tel_error').html(tel_error)
        } else {
            tel_error = ''
            $('#tel_error').html()
        }
        if (!adrss1) {
            adrss1_error = '<i class="fa fa-circle-exclamation text-danger"></i> Adresse obligatorie'
            $('#adrss1_error').html()
            $('#adrss1_error').html(adrss1_error)
        } else {
            adrss1_error = ''
            $('#adrss1_error').html()
        }
        if (!adrss2) {
            adrss2_error = '<i class="fa fa-circle-exclamation text-danger"></i> Adresse obligatorie'
            $('#adrss2_error').html()
            $('#adrss2_error').html(adrss2_error)
        } else {
            adrss2_error = ''
            $('#adrss2_error').html()
        }
        if (!ville) {
            ville_error = '<i class="fa fa-circle-exclamation text-danger"></i> Ville obligatorie'
            $('#ville_error').html()
            $('#ville_error').html(ville_error)
        } else {
            ville_error = ''
            $('#ville_error').html()
        }
        if (!quartier) {
            quartier_error = '<i class="fa fa-circle-exclamation text-danger"></i> Quartier obligatorie'
            $('#quartier_error').html()
            $('#quartier_error').html(quartier_error)
        } else {
            quartier_error = ''
            $('#quartier_error').html()
        }
        if (!zip) {
            zip_error = '<i class="fa fa-circle-exclamation text-danger"></i> Code Zip obligatorie'
            $('#zip_error').html()
            $('#zip_error').html(zip_error)
        } else {
            zip_error = ''
            $('#zip_error').html()
        }

        if (nom_error != '' || pnom_error != '' || mail_error != '' || tel_error != '' || adrss1_error != '' || adrss2_error != '' || ville_error != '' || quartier_error != '' || zip_error != '') {
            return false
        } else {
            var data = {
                'nom': nom,
                'pnom': pnom,
                'mail': mail,
                'tel': tel,
                'adrss1': adrss1,
                'adrss2': adrss2,
                'ville': ville,
                'quartier': quartier,
                'zip': zip
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "/cmd-place2",
                data: data,
                success: function(response) {
                    $('.verifie').load(location.href + " .verifie")
                    swal(response.status);
                }
            });
        }
    });
})