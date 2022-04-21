<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Panier;
use App\Models\Favorie;
use App\Models\Materiel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriesController extends Controller
{
    public function index()
    {
        $favories = Favorie::where('user_id', Auth::id())->get();
        return view('frontend.favories',[
            'favories' => $favories
        ]);
    }


    //Ajout favorie
    public function ajoutFavorie(Request $request)
    {
        $materiel_id = $request -> materiel_id;
        $materiel_nb = $request -> materiel_nb;
        if(Auth::check())
        {
            $mat_check = Materiel::where('id', $materiel_id )->first();

            if($mat_check)
            {
                if(Favorie::where('materiel_id', $materiel_id )->where('user_id', Auth::id())->exists())
                {
                    return response() -> json(['status' => $mat_check-> tag . ' est déjà dans la liste d\'envie']);
                }
                else
                {
                    Favorie::create([
                        'materiel_id' => $materiel_id,
                        'qte_mat' => $materiel_nb,
                        'user_id' => Auth::id(),
                    ]);
                    return response() -> json(['status' => $mat_check-> tag . ' ajouté dans la liste d\'envie']);
                }
            }
        }
        else
        {
            return response() ->  json(['status' => 'Connectez vous pour continuer']);
        }
    }

    //Ajout materiel dns le panier
    public function ajoutMateriel(Request $request)
    {
        $materiel_id = $request -> materiel_id;
        $materiel_nb = $request -> materiel_nb;
        if(Auth::check())
        {
            $mat_check = Materiel::where('id', $materiel_id )->first();

            if($mat_check)
            {
                if(Panier::where('materiel_id', $materiel_id )->where('user_id', Auth::id())->exists())
                {
                    return response() -> json(['status' => $mat_check-> tag . ' est déjà dans le panier']);
                }
                else
                {
                    Panier::create([
                        'materiel_id' => $materiel_id,
                        'user_id' => Auth::id(),
                        'qte_mat' => $materiel_nb,
                    ]);
                    Favorie::where('materiel_id', $materiel_id )->where('user_id', Auth::id())->delete();
                    return response() -> json(['status' => $mat_check-> tag . ' ajouté dans le panier']);
                }
            }
        }
        else
        {
            return response() -> json(['status' => 'Connectez vous pour continuer']);
        }
    }

    public function supMateriel(Request $request)
    {
        $mat_id = $request -> mat_id;
        if (Auth::check()){
            if (Favorie::where('materiel_id', $mat_id)->where('user_id',Auth::id())->exists()) {
                Favorie::where('materiel_id', $mat_id)->where('user_id',Auth::id())->first()->delete();
                return response() -> json(['status' => 'Materiel supprimé des favories']);
            }
        }
        else{
            return response() -> json(['status' => 'Connectez vous pour continuer']);
        }
    }

    public function notifNavBra()
    {
        $count = Favorie::where('user_id',Auth::id())->count();
        return response()->json(['count' => $count]);
    }
}
