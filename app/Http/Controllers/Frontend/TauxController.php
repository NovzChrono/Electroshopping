<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Commande;
use App\Models\Materiel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Taux;
use Illuminate\Support\Facades\Auth;

class TauxController extends Controller
{
    public function ajoutNote(Request $request)
    {
        $note = $request -> product_rating;
        $commentaire = $request -> commentaire;
        $mat_id = $request -> materiel_id;
        if ($commentaire == '') {
            $commentaire = ' ';
        }
        $materiel = Materiel::where('id', $mat_id)->first();
        if($materiel){
            $verification = Commande::where('commandes.user_id', Auth::id())->where('statut','1')
            ->join('item_cmds','commandes.id','item_cmds.cmd_id')
            ->where('item_cmds.mat_id', $mat_id)->get();
            if($verification -> count() > 0){
                $exist_note_user = Taux::where('user_id', Auth::id())->where('materiel_id', $mat_id)->exists();
                if ($exist_note_user) {
                    $note_user = Taux::where('user_id', Auth::id())->where('materiel_id', $mat_id)->first();
                    $note_user->note = $note;
                    $note_user->commentaire = $commentaire;
                    $note_user -> update();
                    return redirect()->back()->with('status','Note modifié');
                }else{
                    Taux::create([
                        'user_id' => Auth::id(),
                        'materiel_id' => $mat_id,
                        'note' => $note,
                        'commentaire' => $commentaire
                    ]);
                    return redirect()->back()->with('status','Note ajouté');
                }
            }else{
                return redirect()->back()->with('status','Vous ne pouvez pas notez cet produit');
            }
        }else {
            return redirect()->back()->with('status','Pas de produit à noté');
        }
    }
}
