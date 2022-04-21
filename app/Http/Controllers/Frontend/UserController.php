<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Item_cmd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $commandes = Commande::where('user_id', Auth::id())->OrderByDESC('created_at')->get();
        return view('frontend.commandes.index',[
            'commandes' => $commandes
        ]);
    }
    public function suivre($id)
    {
        $commande = Commande::where('id',$id)->where('user_id', Auth::id())->first();
        $cmditem = Item_cmd::where('cmd_id',$id)->get();
        return view('frontend.commandes.suivre',[
            'cmd' => $commande,
            'items' => $cmditem
        ]);
    }
}
