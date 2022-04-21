<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategorieController extends Controller
{
    public function index(){
        $categorie = Categorie::All();
        return view('admin.categorie.index',[
            'categorie' => $categorie
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
            'nom' => ['required','min:5','max:50'],
            'slug' => 'max:50',
            'description' => 'required|min:10',
            'image' => 'required'
        ]);

        if($request -> hasFile('image')){
            $file = $request->file('image');
            $ext = $file -> getClientOriginalExtension();
            $filename = time(). '.'. $ext;
            $file->move('assets/uploads/categorie/',$filename);
        }
        Categorie::create([
            'nom' => $request -> nom,
            'slug' => $request -> slug,
            'description' => $request -> description,
            'statut' => $request -> boolean('statut'),
            'popular' => $request -> boolean('popular'),
            'image' => $filename,
            'meta_title' => $request -> mtitle,
            'meta_descrip' => $request -> mdescrip,
            'meta_keyword' => $request -> mkey,
        ]);
        return redirect('/dashboard')->with('status',"Categorie ajouté avec succès");
    }

    //modifier dans la bd
    public function edit($id){
        $search = Categorie::find($id);
        return view('admin.categorie.edit',compact('search'));
    }
    public function update(Request $request, $id){

        $article = Categorie::find($id);
        $filename = $article -> image;

        if($request -> hasFile('image')){
            $path = 'asset/uploads/categorie/'. $article ->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file -> getClientOriginalExtension();
            $filename = time(). '.'. $ext;
            $file->move('assets/uploads/categorie/',$filename);
        }
        Categorie::where('id', $id) -> update([
            'nom' => $request -> nom,
            'slug' => $request -> slug,
            'description' => $request -> description,
            'statut' => $request -> boolean('statut'),
            'popular' => $request -> boolean('popular'),
            'image' => $filename,
            'meta_title' => $request -> mtitle,
            'meta_descrip' => $request -> mdescrip,
            'meta_keyword' => $request -> mkey,
        ]);
        return redirect('/dashboard')->with('status',"Materiel modifié avec succès");
    }



    public function delet($id){
        $search = Categorie::find($id);
        return view('admin.categorie.delete',compact('search'));
    }
    public function delete($id){

        Categorie::where('id', $id) -> delete();

        return redirect('/dashboard')->with('status',"Materiel Supprimer avec succès");
    }
}
