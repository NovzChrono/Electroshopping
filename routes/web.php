<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FontendController;
use App\Http\Controllers\Admin\MaterielController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\CategorieMaterielController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\MarqueControlleur;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VendeurControlleur;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FavoriesController;
use App\Http\Controllers\Frontend\PanierController;
use App\Http\Controllers\Frontend\TauxController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\VerifieController;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//pages user::All
Route::get('/',[FrontendController::class,'index'])->name('accueil');
Route::get('/categorie',[FrontendController::class,'categorie'])->name('categorie');
Route::get('/categorie/{libelleCatMat}',[FrontendController::class,'clickcategorie']);
Route::get('/categorie/{libelleCatMat}/{id}',[FrontendController::class,'clickmateriel']);
Route::get('/all-materiel',[FrontendController::class,'AllMateriel']);
Route::get('/propos',[FrontendController::class,'Apropos'])->name('propos');

Route::get('/contact',[ContactController::class,'index'])->name('contact');
Route::post('/ok',[ContactController::class,'store']);





Auth::routes();


Route::get('/nb-panier-notif',[PanierController::class,'notifNavBra']);
Route::get('/nb-favories-notif',[FavoriesController::class,'notifNavBra']);

//search
Route::get('/list-materiel',[FrontendController::class,'listMatAjax']);
Route::get('/list-materiels',[FrontendController::class,'listMatAjax']);
Route::get('/rechercher',[FrontendController::class,'rechercheMateriel'])->name('rechercher');
Route::get('/categories/{libelle}/{search}',[FrontendController::class,'searchClickCat']);
Route::get('/marques/{nom}/{search}',[FrontendController::class,'searchClickMak']);


Route::get('/marque',[FrontendController::class,'marques'])->name('marque');
Route::get('/marque/{nom}',[FrontendController::class,'searchMarque']);
Route::get('/marque/{nom}/{materiel}',[FrontendController::class,'searchClickMarque']);

Route::get('/tendance',[FrontendController::class,'Tendance']);
Route::get('/tendance/{libelle}',[FrontendController::class,'TendanceCategorie']);

/*PANIER
    *Ajouter
        *Supprimer
            *Modifier
*/
Route::post('/ajout-panier', [PanierController::class,'ajoutMateriel']);
Route::post('/sup-mat-panier',[PanierController::class,'supMateriel']);
Route::post('/update-panier',[PanierController::class,'updateMateriel']);

Route::post('/ajout-favorie',[FavoriesController::class, 'ajoutFavorie']);
Route::post('/ajout-favorie-panier', [FavoriesController::class,'ajoutMateriel']);
Route::post('/sup-mat-favorie',[FavoriesController::class,'supMateriel']);


//Authentifié avec un compte
Route::middleware(['auth'])->group(function () {

    //Ajout cmd panier
    Route::get('/panier', [PanierController::class,'viewpanier'])->name('panier');
    Route::get('/verifie', [VerifieController::class,'index']);
    Route::post('/cmd-place', [VerifieController::class,'passecmd']);
    Route::post('/cmd-place2', [VerifieController::class,'passecmd2']);


    //Commande
    Route::get('/mes-commandes', [UserController::class,'index']);
    Route::get('/suivre-commande/{id}', [UserController::class,'suivre']);

    //Favories
    Route::get('/Favories_user',[FavoriesController::class,'index'])->name('favories');

    //taux
    Route::post('/ajout-note',[TauxController::class,'ajoutNote']);

    //paiement
    Route::post('/proceder-au-paiement',[VerifieController::class,'cinetPay']);

    //Paramettre
    Route::get('/profil',[FrontendController::class,'paramettre'])->name('profil');
    Route::post('/modif-infos',[FrontendController::class,'modifieInfos']);
    Route::post('/modif-mdp',[FrontendController::class,'modifieMdp']);


});

//Administrateur
Route::middleware(['auth', 'isAdmin'])->group(function () {
    

    //sur mon dashboard
    Route::get('/dashboard', [FontendController::class,'index']) -> name('dashboard');
    Route::get('/cmd_day', [FontendController::class,'cmdDay']);
    Route::get('/user_day', [FontendController::class,'userDay']);
    Route::get('/cmd_no_complete', [FontendController::class,'cmdNoC']);
    Route::get('/cmd_rupture', [FontendController::class,'cmdRupture']);

    //recherche sur la suivie de la ma commande
    Route::get('/list-commande',[FontendController::class,'listSuivAjax']);
    Route::get('/recherche_suivie',[FontendController::class,'rechercheSuivie'])->name('recherche_suivie');
    Route::get('commande/statut/{id}',[FontendController::class,'voirCommande']);

    //recherche sur le numero de telephone du client
    Route::get('/list-numero',[FontendController::class,'listTelAjax']);
    Route::get('/recherche_tel',[FontendController::class,'rechercheTel'])->name('recherche_tel');

    //paramettre pour l'administrateur connecter pour modifier ces info personnelle et son mot de passe
    Route::get('/compte_admin',[FontendController::class,'paramettre']);
    Route::post('/modif_info_admin',[FontendController::class,'modifieCompte']);
    Route::get('/compte_pwd',[FontendController::class,'paramettrePwd']);
    Route::post('/modif_pwd_admin',[FontendController::class,'modifiePwd']);


    /*Categorie Materiel
    *Ajouter
        *Supprimer
            *Modifier
                *Affiché
    */
    Route::get('/categories', [CategorieMaterielController::class,'index']) -> name('categories');
    Route::get('ajout-categorie', [CategorieMaterielController::class,'ajout']);
    Route::post('insert-categorie', [CategorieMaterielController::class, 'insert']);
    Route::get('edit-categorie/{id}', [CategorieMaterielController::class, 'edit']);
    Route::put('update-categorie/{id}',[CategorieMaterielController::class, 'update']);
    Route::get('destroy-categorie/{id}',[CategorieMaterielController::class, 'destroy']);


    /*Materiel
    *Ajouter
        *Supprimer
            *Modifier
                *Affiché
    */
    Route::get('/materiels', [MaterielController::class,'index']) -> name('materiels');
    Route::get('ajout-materiel', [MaterielController::class,'ajout']);
    Route::post('insert-materiel', [MaterielController::class, 'insert']);
    Route::get('edit-materiel/{id}', [MaterielController::class, 'edit']);
    Route::put('update-materiel/{id}',[MaterielController::class, 'update']);
    Route::get('destroy-materiel/{id}',[MaterielController::class, 'destroy']);

    /*Vendeur
    *Ajouter
        *Supprimer
            *Modifier
                *Affiché
    */
    Route::get('/vendeurs', [VendeurControlleur::class,'index']) -> name('vendeurs');
    Route::get('ajout-vendeur', [VendeurControlleur::class,'ajout']);
    Route::post('insert-vendeur', [VendeurControlleur::class, 'insert']);
    Route::get('edit-vendeur/{id}', [VendeurControlleur::class, 'edit']);
    Route::put('update-vendeur/{id}',[VendeurControlleur::class, 'update']);
    Route::get('destroy-vendeur/{id}',[VendeurControlleur::class, 'destroy']);

    /* Marque
    *Ajouter
        *Supprimer
            *Modifier
                *Affiché
    */
    Route::get('/marques', [MarqueControlleur::class,'index']) -> name('marques');
    Route::get('ajout-marque', [MarqueControlleur::class,'ajout']);
    Route::post('insert-marque', [MarqueControlleur::class, 'insert']);
    Route::get('edit-marque/{id}', [MarqueControlleur::class, 'edit']);
    Route::put('update-marque/{id}',[MarqueControlleur::class, 'update']);
    Route::get('destroy-marque/{id}',[MarqueControlleur::class, 'destroy']);

    /*Commande
    *En attente -> statut 0
        *Complete -> statut 1
            *Modifier
                *Affiché
    */
    Route::get('/commandes',[CommandeController::class, 'index'])->name('commandes');
    Route::get('commande/attente/{id}',[CommandeController::class,'voirCommande']);
    Route::put('commande/attente/update/{id}',[CommandeController::class,'updateStatut']);
    Route::get('commandes/complete',[CommandeController::class,'cmdComplete']);
    Route::get('commande/complete/{id}',[CommandeController::class,'VoirCmdComplete']);
    Route::get('facture/{id}',[CommandeController::class,'Facture']);

    /*Users
        *Affiché
    */




 });

Route::middleware(['auth', 'superAdmin'])->group(function () {
    

    //sur mon dashboard
    Route::get('/dashboard', [FontendController::class,'index']) -> name('dashboard');
    Route::get('/cmd_day', [FontendController::class,'cmdDay']);
    Route::get('/user_day', [FontendController::class,'userDay']);
    Route::get('/cmd_no_complete', [FontendController::class,'cmdNoC']);
    Route::get('/cmd_rupture', [FontendController::class,'cmdRupture']);

    //recherche sur la suivie de la ma commande
    Route::get('/list-commande',[FontendController::class,'listSuivAjax']);
    Route::get('/recherche_suivie',[FontendController::class,'rechercheSuivie'])->name('recherche_suivie');
    Route::get('commande/statut/{id}',[FontendController::class,'voirCommande']);

    //recherche sur le numero de telephone du client
    Route::get('/list-numero',[FontendController::class,'listTelAjax']);
    Route::get('/recherche_tel',[FontendController::class,'rechercheTel'])->name('recherche_tel');

    //paramettre pour l'administrateur connecter pour modifier ces info personnelle et son mot de passe
    Route::get('/compte_admin',[FontendController::class,'paramettre']);
    Route::post('/modif_info_admin',[FontendController::class,'modifieCompte']);
    Route::get('/compte_pwd',[FontendController::class,'paramettrePwd']);
    Route::post('/modif_pwd_admin',[FontendController::class,'modifiePwd']);


    /*Categorie Materiel
    *Ajouter
        *Supprimer
            *Modifier
                *Affiché
    */
    Route::get('/categories', [CategorieMaterielController::class,'index']) -> name('categories');
    Route::get('ajout-categorie', [CategorieMaterielController::class,'ajout']);
    Route::post('insert-categorie', [CategorieMaterielController::class, 'insert']);
    Route::get('edit-categorie/{id}', [CategorieMaterielController::class, 'edit']);
    Route::put('update-categorie/{id}',[CategorieMaterielController::class, 'update']);
    Route::get('destroy-categorie/{id}',[CategorieMaterielController::class, 'destroy']);


    /*Materiel
    *Ajouter
        *Supprimer
            *Modifier
                *Affiché
    */
    Route::get('/materiels', [MaterielController::class,'index']) -> name('materiels');
    Route::get('ajout-materiel', [MaterielController::class,'ajout']);
    Route::post('insert-materiel', [MaterielController::class, 'insert']);
    Route::get('edit-materiel/{id}', [MaterielController::class, 'edit']);
    Route::put('update-materiel/{id}',[MaterielController::class, 'update']);
    Route::get('destroy-materiel/{id}',[MaterielController::class, 'destroy']);

    /*Vendeur
    *Ajouter
        *Supprimer
            *Modifier
                *Affiché
    */
    Route::get('/vendeurs', [VendeurControlleur::class,'index']) -> name('vendeurs');
    Route::get('ajout-vendeur', [VendeurControlleur::class,'ajout']);
    Route::post('insert-vendeur', [VendeurControlleur::class, 'insert']);
    Route::get('edit-vendeur/{id}', [VendeurControlleur::class, 'edit']);
    Route::put('update-vendeur/{id}',[VendeurControlleur::class, 'update']);
    Route::get('destroy-vendeur/{id}',[VendeurControlleur::class, 'destroy']);

    /* Marque
    *Ajouter
        *Supprimer
            *Modifier
                *Affiché
    */
    Route::get('/marques', [MarqueControlleur::class,'index']) -> name('marques');
    Route::get('ajout-marque', [MarqueControlleur::class,'ajout']);
    Route::post('insert-marque', [MarqueControlleur::class, 'insert']);
    Route::get('edit-marque/{id}', [MarqueControlleur::class, 'edit']);
    Route::put('update-marque/{id}',[MarqueControlleur::class, 'update']);
    Route::get('destroy-marque/{id}',[MarqueControlleur::class, 'destroy']);

    /*Commande
    *En attente -> statut 0
        *Complete -> statut 1
            *Modifier
                *Affiché
    */
    Route::get('/commandes',[CommandeController::class, 'index'])->name('commandes');
    Route::get('commande/attente/{id}',[CommandeController::class,'voirCommande']);
    Route::put('commande/attente/update/{id}',[CommandeController::class,'updateStatut']);
    Route::get('commandes/complete',[CommandeController::class,'cmdComplete']);
    Route::get('commande/complete/{id}',[CommandeController::class,'VoirCmdComplete']);
    Route::get('facture/{id}',[CommandeController::class,'Facture']);

    /*Users
        *Affiché
    */
    Route::get('/users',[UsersController::class, 'index'])->name('users');
    Route::get('user/{id}',[UsersController::class, 'voirUser']);
    Route::get('/employes',[UsersController::class, 'employes']);
    Route::get('/ajout-employes',[UsersController::class, 'ajout']);
    Route::post('insert-employe', [UsersController::class, 'insert']);
    Route::get('/delete-user/{id}',[UsersController::class, 'detroy']);




 });
Route::fallback(function() {
   return view('frontend.error404');
});