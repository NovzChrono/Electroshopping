<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Categorie_materiel;
use App\Http\Controllers\Controller;
use App\Models\Materiel;
use Illuminate\Support\Facades\File;


class CategorieMaterielController extends Controller
{
    public function index(){
        $categories = Categorie_materiel::All();
        return view('admin.categorie.index',[
            'categorie' => $categories
        ]);
    }
    public function ajout(){
        return view('admin.categorie.ajout');
    }
    /*
        @ajout bd
    */
    public function insert(Request $request){

        $request ->validate([
            'libelle' => ['required'],
            'description' => 'required|min:10',
            'image' => 'required'
        ]);
        if(Categorie_materiel::where('libelleCatMat', $request->libelle)->exists())
        {
            return redirect('/categories')->with('echec',"Categorie existe déjà");
        }
        else
        {
            if($request -> hasFile('image'))
            {
                $file = $request->file('image');
                $ext = $file -> getClientOriginalExtension();
                $filename = time(). '.'. $ext;
                $file->move('assets/uploads/categorie/',$filename);
            }
            Categorie_materiel::create([
                'libelleCatMat' => $request -> libelle,
                'descriptionCatMat' => $request -> description,
                'imageCatMat' => $filename,
                'statutCatMat' => $request -> boolean('statut'),
                'popularCatMat' => $request -> boolean('popular')
            ]);
            return redirect('/categories')->with('status',"Categories de materiel ajouté avec succès");
        }
    }

    //modifier dans la bd
    public function edit($id){
        $search = Categorie_materiel::find($id);
        return view('admin.categorie.edit',[
            'search' => $search
        ]);
    }
    public function update(Request $request, $id){
        $request ->validate([
            'libelle' => ['required','min:3','max:50'],
            'description' => 'required|min:10'
        ]);
        $article = Categorie_materiel::find($id);
        $filename = $article -> imageCatMat;

        if($request -> hasFile('image')){
            $path = 'assets/uploads/categorie/'. $article ->imageCatMat;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file -> getClientOriginalExtension();
            $filename = time(). '.'. $ext;
            $file->move('assets/uploads/categorie/',$filename);
        }

        Categorie_materiel::where('id', $id) -> update([
            'libelleCatMat' => $request -> libelle,
            'descriptionCatMat' => $request -> description,
            'imageCatMat' => $filename,
            'statutCatMat' => $request -> boolean('statut'),
            'popularCatMat' => $request -> boolean('popular')
        ]);
        return redirect('/categories')->with('status',"Categorie de materiel modifié avec succès");
    }

    public function destroy($id){
        if(Materiel::where('categorie_materiel_id',$id)->exists())
        {
            return redirect('/categories')->with('echec',"Impossible de supprimé la categorie");
        }
        else
        {
            $article = Categorie_materiel::find($id);
            if($article -> imageCatMat)
            {
                $path = 'assets/uploads/categorie/'. $article ->imageCatMat;
                if(File::exists($path))
                {
                    File::delete($path);
                }
            }
            Categorie_materiel::where('id', $id) -> delete();

            return redirect('/categories')->with('status',"Categorie de materiel Supprimer avec succès");
        }
    }
}
