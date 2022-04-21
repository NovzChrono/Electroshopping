<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie_materiel;
use App\Models\Marque;
use App\Models\Materiel;
use App\Models\Vendeur;
use Illuminate\Support\Facades\File;

class MaterielController extends Controller
{
    public function index(){
        $materiel = Materiel::OrderByDESC('created_at')->get();
        return view('admin.materiel.index',[
            'materiel' => $materiel
        ]);
    }
    public function ajout(){
        $categorie = Categorie_materiel::orderby('libelleCatMat')->get();
        $vendeurs = Vendeur::orderby('nom')->OrderBy('pnoms')->get();
        $marques = Marque::orderby('nom')->get();
        return view('admin.materiel.ajout', compact('categorie','vendeurs','marques'));
    }
    /*
        @ajout bd
    */
    public function insert(Request $request){
        $request ->validate([
            'nom' => ['required','min:3'],
            'tag' => ['required'],
            'nomv' => ['required'],
            'prixr' => 'required|max:10',
            'qte' => 'required|max:8',
            'taxe' => 'required|max:5',
            'description' => 'required|min:10',
            'gdescription' => 'required|min:10',
            'image' => 'required',
            
        ]);
        if(!$request -> prixn)
        {
            $request -> prixn = 1;
        }
        if($request -> hasFile('image')){
            $file = $request->file('image');
            $ext = $file -> getClientOriginalExtension();
            $filename = time(). '.'. $ext;
            $file->move('assets/uploads/materiel/',$filename);
        }
        if($request -> hasFile('image2')){
            $file2 = $request->file('image2');
            $ext = $file2 -> getClientOriginalExtension();
            $filename2 = time(). '.'. $ext;
            $file2->move('assets/uploads/materiel2/',$filename2);
        }else{
            $filename2 = '';
        }
        if($request -> hasFile('image3')){
            $file3 = $request->file('image3');
            $ext = $file3 -> getClientOriginalExtension();
            $filename3 = time(). '.'. $ext;
            $file3->move('assets/uploads/materiel3/',$filename3);
        }else{
            $filename3 = '';
        }
        Materiel::create([
            'nom_mat' => $request -> nom,
            'tag' => $request -> tag,
            'marque_id' => $request -> marque,
            'vendeur_id' => $request -> nomv,
            'description_mat' => $request -> description,
            'gdescription_mat' => $request -> gdescription,
            'prixnormal_mat' => $request -> prixn,
            'prixreduit_mat' => $request -> prixr,
            'qte_mat' => $request -> qte,
            'impot_mat' => $request -> taxe,
            'statut_mat' => $request -> boolean('statut'),
            'popular_mat' => $request -> boolean('popular'),
            'image_mat' => $filename,
            'image2_mat' => $filename2,
            'image3_mat' => $filename3,
            'categorie_materiel_id' => $request -> fk_cm
        ]);
        return redirect('/materiels')->with('status',"Materiel ajouté avec succès");
    }

    //modifier dans la bd
    public function edit($id){
        $search = Materiel::find($id);
        $idCat = $search -> categorie_materiel_id;
        return view('admin.materiel.edit',[
            'search' => $search,
        ]);
    }
    public function update(Request $request, $id){
        $request ->validate([
            'nom' => ['required','min:3'],
            'tag' => ['required'],
            'prixr' => 'required|max:10',
            'qte' => 'required|max:8',
            'taxe' => 'required|max:5',
            'description' => 'required|min:10',
            'gdescription' => 'required|min:10'
        ]);
        if($request -> prixn =='')
        {
            $request -> prixn = ' ';
        }
        $article = Materiel::find($id);
        // Image 1
        $filename = $article -> image_mat;
        if($request -> hasFile('image')){
            $path = 'assets/uploads/materiel/'. $article ->image_mat;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file -> getClientOriginalExtension();
            $filename = time(). '.'. $ext;
            $file->move('assets/uploads/materiel/',$filename);
        }
        // Image 2
        $filename2 = $article -> image2_mat;
        if($request -> hasFile('image2')){
            $path2 = 'assets/uploads/materiel2/'. $article ->image2_mat;
            if(File::exists($path2)){
                File::delete($path2);
            }
            $file2 = $request->file('image2');
            $ext = $file2 -> getClientOriginalExtension();
            $filename2 = time(). '.'. $ext;
            $file2->move('assets/uploads/materiel2/',$filename2);
        }
        // Image 3
        $filename3 = $article -> image3_mat;
        if($request -> hasFile('image3')){
            $path3 = 'assets/uploads/materiel3/'. $article ->image3_mat;
            if(File::exists($path3)){
                File::delete($path3);
            }
            $file3 = $request->file('image3');
            $ext = $file3 -> getClientOriginalExtension();
            $filename3 = time(). '.'. $ext;
            $file3->move('assets/uploads/materiel3/',$filename3);
        }
        Materiel::where('id', $id) -> update([
            'nom_mat' => $request -> nom,
            'tag' => $request -> tag,
            'description_mat' => $request -> description,
            'gdescription_mat' => $request -> gdescription,
            'prixnormal_mat' => $request -> prixn,
            'prixreduit_mat' => $request -> prixr,
            'qte_mat' => $request -> qte,
            'impot_mat' => $request -> taxe,
            'statut_mat' => $request -> boolean('statut'),
            'popular_mat' => $request -> boolean('popular'),
            'image_mat' => $filename,
            'image2_mat' => $filename2,
            'image3_mat' => $filename3,
            'categorie_materiel_id' => $article -> categorie_materiel_id
        ]);
        return redirect('/materiels')->with('status',"Materiel modifié avec succès");
    }

    public function destroy($id){
        $article = Materiel::find($id);
        if($article -> image_mat)
        {
            $path = 'assets/uploads/materiel/'. $article ->image_mat;
            if(File::exists($path))
            {
                File::delete($path);
            }
        }
         if($article -> image_mat2)
        {
            $path = 'assets/uploads/materiel2/'. $article ->image_mat2;
            if(File::exists($path))
            {
                File::delete($path);
            }
        }
         if($article -> image_mat3)
        {
            $path = 'assets/uploads/materiel3/'. $article ->image_mat3;
            if(File::exists($path))
            {
                File::delete($path);
            }
        }
        Materiel::where('id', $id) -> delete();

        return redirect('/materiels')->with('status',"Materiel Supprimer avec succès");
    }
}
