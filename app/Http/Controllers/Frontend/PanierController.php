<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Panier;
use App\Models\Materiel;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{
    //Ajout dans le panier avec Ajax
    public function ajoutMateriel(Request $request){
        $materiel_id = $request -> materiel_id;
        $materiel_nb = $request -> materiel_nb;
        if(Auth::check())
        {
            $mat_check = Materiel::where('id', $materiel_id )->where('qte_mat','>','0')->exists();
            $mat_check1 = Materiel::where('id', $materiel_id )->first();
            if($mat_check)
            {
                if(Panier::where('materiel_id', $materiel_id )->where('user_id', Auth::id())->exists())
                {
                    return response() -> json(['status' => $mat_check1-> tag . ' est déjà dans le panier']);
                }
                else
                {
                    Panier::create([
                        'materiel_id' => $materiel_id,
                        'user_id' => Auth::id(),
                        'qte_mat' => $materiel_nb,
                    ]);
                    return response() -> json(['status' => $mat_check1-> tag . ' ajouté dans le panier']);
                }
            }
            else
            {
                return response() -> json(['status' => $mat_check1-> nom_mat . ' est en rupture de stock']);
            }
        }
        else
        {
            return response() -> json(['status' => 'Connectez vous pour continuer']);
        }
    }
    //Page Panier
    public function viewpanier(){

        $panier = Panier::where('user_id', Auth::id())->get();
        if (($panier -> count()) > 0) {
            return view('frontend.panier.panier',[
                'panier' => $panier
            ]);
        }else{
            $panier = 0;
            return view('frontend.panier.panier',[
                'panier' => $panier
            ]);
        }
    }

    /*
            Supprimer un meteriel que nous avons ajouter auparavant qui est dans notre panier
            *avec ajax
    */
    public function supMateriel(Request $request)
    {
        $mat_id = $request -> mat_id;
        if (Auth::check()){
            if (Panier::where('materiel_id', $mat_id)->where('user_id',Auth::id())->exists()) {
                Panier::where('materiel_id', $mat_id)->where('user_id',Auth::id())->first()->delete();
                return response() -> json(['status' => 'Materiel supprimé']);
            }
        }
        else{
            return response() -> json(['status' => 'Connectez vous pour continuer']);
        }
    }

    /*
            Modifier un materiel que nous avons ajouter auparavant qui est dans notre panier
            *avec ajax
    */
    public function updateMateriel(Request $request)
    {
        $mat_id = $request -> mat_id;
        $mat_qte = $request -> mat_qte;
        if (Auth::check()) {
            if (Panier::where('materiel_id', $mat_id)->where('user_id',Auth::id())->exists()) {
                Panier::where('materiel_id', $mat_id)->where('user_id',Auth::id())->update([
                    'qte_mat' => $mat_qte,
                ]);
            }
            return response() -> json(['status' => 'Materiel modifié']);
        }
        else{
            return response() -> json(['status' => 'Connectez vous pour continuer']);
        }
    }

    public function notifNavBra()
    {
        $count = Panier::where('user_id',Auth::id())->count();
        return response() -> json(['count' => $count]);
    }
}
