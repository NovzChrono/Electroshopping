<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Panier;
use App\Models\Materiel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Item_cmd;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerifieController extends Controller
{
    // url panier
    public function index()
    {
        
            $items = Panier::where('user_id', Auth::id())->get();
            foreach ($items as $item ) {
                if (!Materiel::where('id', $item-> materiel_id)->where('qte_mat','>=',$item->qte_mat)->exists()) {
                    Panier::where('user_id', Auth::id())->where('materiel_id',$item->materiel_id)->first()->delete();
                }
            }
            $panier_items = Panier::where('user_id', Auth::id())->get();
            return view('frontend.panier.verifie',[
                'itempanier' => $panier_items,
            ]);
        
        
    }

    //url verifie
    public function passecmd(Request $request)
    {
        //validation
        $request ->validate([
            'nom' => ['required'],
            'pnom' => 'required',
            'mail' => 'required',
            'tel' => 'required',
            'adrss1' => 'required',
            'adrss2' => 'required',
            'ville' => 'required',
            'quartier' => 'required',
            'zip' => 'required',
        ]);

        //crée une commande
        $total =0;
        $total_items = Panier::where('user_id', Auth::id())->get();
        foreach ($total_items as $mat) {
            $total += $mat->qte_mat*$mat->materiels->prixreduit_mat;
        }
        $cmd = Commande::create([
            'user_id' => Auth::id(),
            'nom' => $request -> nom,
            'pnom' => $request -> pnom,
            'email' => $request -> mail,
            'tel' => $request -> tel,
            'adrss1' => $request -> adrss1,
            'adrss2' => $request -> adrss2,
            'ville' => $request -> ville,
            'quartier' => $request -> quartier,
            'total' => $total,
            'codepin' => $request -> zip,
            'suivie_nb' => 'novz'.rand(111111111,999999999),
            'date' => date('y-m-d'),
        ]);

        //crée un _cmditem
        $panier_items = Panier::where('user_id', Auth::id())->get();
        foreach ($panier_items as $item) {
            Item_cmd::create([
                'cmd_id' => $cmd->id,
                'mat_id' => $item -> materiel_id,
                'qte' => $item -> qte_mat,
                'total' => $item->qte_mat*$item->materiels->prixreduit_mat
            ]);

            $mat = Materiel::where('id',$item -> materiel_id)->first();
            $mat -> qte_mat =  $mat -> qte_mat - $item -> qte_mat;
            $mat->update();
        }

        //voir dans la bd si user n'a pas saisie deja l'adresse
        if(Auth::user()->adrss1 == NULL){
            User::where('id', Auth::id())->first()->update([
                'name' => $request -> nom,
                'pnom' => $request -> pnom,
                'tel' => $request -> tel,
                'adrss1' => $request -> adrss1,
                'adrss2' => $request -> adrss2,
                'ville' => $request -> ville,
                'quartier' => $request -> quartier,
                'codepin' => $request -> zip,
            ]);
        }

        //verfier si les données concernant l'utilisateur qui etait deja dans la bd n'ont pas été modifié
        if (Auth::user()->name != $request -> nom ||
            Auth::user()->pnom != $request -> pnom ||
            Auth::user()->tel != $request -> tel ||
            Auth::user()->adrss1 != $request -> adrss1 ||
            Auth::user()->adrss2 != $request -> adrss2 ||
            Auth::user()->ville != $request -> ville ||
            Auth::user()->quartier != $request -> quartier ||
            Auth::user()->codepin != $request -> zip) {
                User::where('id', Auth::id())->first()->update([
                    'name' => $request -> nom,
                    'pnom' => $request -> pnom,
                    'tel' => $request -> tel,
                    'adrss1' => $request -> adrss1,
                    'adrss2' => $request -> adrss2,
                    'ville' => $request -> ville,
                    'quartier' => $request -> quartier,
                    'codepin' => $request -> zip,
                ]);
        }

        //detruit le panier après avoir enregistré le cmd
        $panier_items = Panier::where('user_id', Auth::id())->get();
        Panier::destroy($panier_items);

        return response() -> json(['status' => 'Commande passé avec succès vous serez contacté']);

       // return redirect('/verifie') -> with('statut', 'OK');
    }

    //domicile livraison
    public function passecmd2(Request $request)
    {
         //validation
        $request ->validate([
            'nom' => ['required'],
            'pnom' => 'required',
            'mail' => 'required',
            'tel' => 'required',
            'adrss1' => 'required',
            'adrss2' => 'required',
            'ville' => 'required',
            'quartier' => 'required',
            'zip' => 'required',
        ]);
        $domicile = 1000;
        //crée une commande
        $total =0;
        $total_items = Panier::where('user_id', Auth::id())->get();
        foreach ($total_items as $mat) {
            $total += $mat->qte_mat*$mat->materiels->prixreduit_mat;
        }
        $cmd = Commande::create([
            'user_id' => Auth::id(),
            'nom' => $request -> nom,
            'pnom' => $request -> pnom,
            'email' => $request -> mail,
            'tel' => $request -> tel,
            'adrss1' => $request -> adrss1,
            'adrss2' => $request -> adrss2,
            'ville' => $request -> ville,
            'quartier' => $request -> quartier,
            'total' => $total,
            'codepin' => $request -> zip,
            'suivie_nb' => 'novz'.rand(111111111,999999999),
            'date' => date('y-m-d'),
            'domicile' => $domicile
        ]);

        //crée un _cmditem
        $panier_items = Panier::where('user_id', Auth::id())->get();
        foreach ($panier_items as $item) {
            Item_cmd::create([
                'cmd_id' => $cmd->id,
                'mat_id' => $item -> materiel_id,
                'qte' => $item -> qte_mat,
                'total' => $item->qte_mat*$item->materiels->prixreduit_mat
            ]);

            $mat = Materiel::where('id',$item -> materiel_id)->first();
            $mat -> qte_mat =  $mat -> qte_mat - $item -> qte_mat;
            $mat->update();
        }

        //voir dans la bd si user n'a pas saisie deja l'adresse
        if(Auth::user()->adrss1 == NULL){
            User::where('id', Auth::id())->first()->update([
                'name' => $request -> nom,
                'pnom' => $request -> pnom,
                'tel' => $request -> tel,
                'adrss1' => $request -> adrss1,
                'adrss2' => $request -> adrss2,
                'ville' => $request -> ville,
                'quartier' => $request -> quartier,
                'codepin' => $request -> zip,
            ]);
        }

        //verfier si les données concernant l'utilisateur qui etait deja dans la bd n'ont pas été modifié
        if (Auth::user()->name != $request -> nom ||
            Auth::user()->pnom != $request -> pnom ||
            Auth::user()->tel != $request -> tel ||
            Auth::user()->adrss1 != $request -> adrss1 ||
            Auth::user()->adrss2 != $request -> adrss2 ||
            Auth::user()->ville != $request -> ville ||
            Auth::user()->quartier != $request -> quartier ||
            Auth::user()->codepin != $request -> zip) {
                User::where('id', Auth::id())->first()->update([
                    'name' => $request -> nom,
                    'pnom' => $request -> pnom,
                    'tel' => $request -> tel,
                    'adrss1' => $request -> adrss1,
                    'adrss2' => $request -> adrss2,
                    'ville' => $request -> ville,
                    'quartier' => $request -> quartier,
                    'codepin' => $request -> zip,
                ]);
        }

        //detruit le panier après avoir enregistré le cmd
        $panier_items = Panier::where('user_id', Auth::id())->get();
        Panier::destroy($panier_items);

        return response() -> json(['status' => 'Commande passé avec succès vous serez contacté']);

       // return redirect('/verifie') -> with('statut', 'OK');
    }

    //CinetPAY
    public function cinetPay(Request $request)
    {
        $panierItems= Panier::where('user_id',Auth::id())->get();
        $total_prix = 0;
        foreach ($panierItems as $item) {
            $total_prix += $item->qte_mat*$item->materiels->prixreduit_mat;
        }
        $nom = $request ->nom;
        $pnom = $request ->pnom;
        $mail = $request ->mail;
        $tel = $request ->tel;
        $adrss1 = $request ->adrss1;
        $adrss2 = $request ->adrss2;
        $ville = $request ->ville;
        $quartier = $request ->quartier;
        $zip = $request ->zip;

        return response() -> json([
            'nom'=> $nom,
            'pnom'=> $pnom,
            'mail'=> $mail,
            'tel'=> $tel,
            'adrss1'=> $adrss1,
            'adrss2'=> $adrss2,
            'ville'=> $ville,
            'quartier'=> $quartier,
            'zip'=> $zip,
            'total_prix' => $total_prix
        ]);
    }
}
