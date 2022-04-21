<?php

namespace App\Http\Controllers\Admin;

use App\Models\Commande;
use App\Models\Item_cmd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommandeController extends Controller
{
    public function index()
    {
       $commandes= Commande::OrderByDESC('created_at')->where('statut','0')->get();
       return view('admin.commande.index',[
           'commandes' => $commandes
       ]);
    }
    public function voirCommande($id)
    {
        $commande= Commande::where('statut','0')->where('id',$id)->first();
        $cmditem = Item_cmd::where('cmd_id',$id)->get();
        return view('admin.commande.cmdattente',[
            'cmd' =>  $commande,
            'items' => $cmditem
        ]);
    }
    public function updateStatut(Request $request, $id)
    {
        $commande = Commande::where('id', $id)->first()->update([
            'statut' => $request -> cmd_statut
        ]);
        return redirect('/commandes') -> with('status','Commande client modifié');
    }

    public function cmdComplete()
    {
        $commandes = Commande::OrderByDESC('created_at')->where('statut','!=','0')->get();
        return view('admin.commande.historycmds',[
            'commandes' => $commandes
        ]);
    }

    public function VoirCmdComplete($id)
    {
        $commande =Commande::where('statut','!=','0')->where('id',$id)->first();
        $cmditem = Item_cmd::where('cmd_id', $id)->get();
        return view('admin.commande.cmdcomplet',[
            'cmd' =>  $commande,
            'items' => $cmditem
        ]);
    }


    public function Facture($id)
    {
        $cmd = Commande::where('id', $id)->first();
        $items_cmd = Item_cmd::where('cmd_id', $id)->get();
        return view('admin.facture.index', compact('cmd','items_cmd'));
    }

}
