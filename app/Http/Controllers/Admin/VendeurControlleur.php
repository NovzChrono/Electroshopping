<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendeur;
use App\Models\Materiel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendeurControlleur extends Controller
{
    
    public function index()
    {
        $vendeurs = Vendeur::OrderByDESC('nom')->OrderByDESC('pnoms')->get();
        return view('admin.vendeur.index',compact('vendeurs'));
    }

    public function ajout()
    {
        return view('admin.vendeur.ajout');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'pnoms' => 'required',
            'tel' => 'required|min:10|unique:vendeurs,tel',
            'adrss' => 'required',
        ]);
        Vendeur::create([
            'nom' =>  $request->nom, 
            'pnoms' => $request->pnoms, 
            'tel' => $request->tel,
            'adrss' => $request->adrss 
        ]);
        return redirect('/vendeurs')->with('status','Vendeur ajouté avec sucèss');
    }

    public function edit($id)
    {
        $vendeur = Vendeur::where('id', $id)->first();
        return view('admin.vendeur.edit',compact('vendeur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'pnoms' => 'required',
            'tel' => 'required|min:10',
            'adrss' => 'required',
        ]);
        Vendeur::where('id', $id)->update([
            'nom' =>  $request->nom, 
            'pnoms' => $request->pnoms, 
            'tel' => $request->tel,
            'adrss' => $request->adrss 
        ]);
        return redirect('/vendeurs')->with('status','Donnée du vendeur modifié avec succès');
    }

    public function destroy($id)
    {
        if(Materiel::where('vendeur_id',$id)->exists())
        {
            return redirect('/vendeurs')->with('echec','Impossible de supprimé le vendeur');
        }
        else {
            Vendeur::where('id', $id)->delete();
            return redirect('/vendeurs')->with('status','Vendeur supprimé avec succès');
        }
    }

    
}
