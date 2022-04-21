<?php

namespace App\Http\Controllers\Admin;

use App\Models\Marque;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Materiel;
use Illuminate\Support\Facades\File;

class MarqueControlleur extends Controller
{
    
    public function index()
    {
        $marque = Marque::OrderByDESC('created_at')->get();
        return view('admin.marque.index',compact('marque'));
    }

    
    public function ajout()
    {
        return view('admin.marque.ajout');
    }

    public function insert(Request $request){

        $request ->validate([
            'libelle' => ['required'],
            'image' => 'required'
        ]);
        if(Marque::where('nom', $request -> libelle)->exists())
        {
            return redirect('/marques')->with('echec',"La marque existe déjà");
        }
        else
        {
            if($request -> hasFile('image'))
            {
                $file = $request->file('image');
                $ext = $file -> getClientOriginalExtension();
                $filename = time(). '.'. $ext;
                $file->move('assets/uploads/marque/',$filename);
            }
            Marque::create([
                'nom' => $request -> libelle,
                'logo' => $filename,
            
            ]);
            return redirect('/marques')->with('status',"Marque ajouté avec succès");
        }
    }

    public function edit($id){
        $search = Marque::find($id);
        return view('admin.marque.edit',[
            'search' => $search
        ]);
    }

    public function update(Request $request, $id){
        $request ->validate([
            'libelle' => ['required']
        ]);
        $article = Marque::find($id);
        $filename = $article -> logo;

        if($request -> hasFile('image')){
            $path = 'assets/uploads/marque/'. $article ->logo;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file -> getClientOriginalExtension();
            $filename = time(). '.'. $ext;
            $file->move('assets/uploads/marque/',$filename);
        }

        Marque::where('id', $id) -> update([
            'nom' => $request -> libelle,
            'logo' => $filename,
        ]);
        return redirect('/marques')->with('status',"Marque modifié avec succès");
    }

    public function destroy($id){
        if(Materiel::where('marque_id',$id)->exists())
        {
            return redirect('/marques')->with('echec',"Impossible de supprimé la marque");
        }
        else
        {
            $article = Marque::find($id);
            if($article -> logo)
            {
                $path = 'assets/uploads/marque/'. $article ->logo;
                if(File::exists($path))
                {
                    File::delete($path);
                }
            }
            Marque::where('id', $id) -> delete();

            return redirect('/marques')->with('status',"Marque Supprimer avec succès");
        }
        
    }
}
