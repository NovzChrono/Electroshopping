<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Taux;
use App\Models\User;
use App\Models\Marque;
use App\Models\Commande;
use App\Models\Materiel;
use Illuminate\Http\Request;
use App\Models\Categorie_materiel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;

class FrontendController extends Controller
{
    public function index(){
        $articles_dernier = Materiel::OrderByDESC('created_at')->take(25)->get();
        $categories = Categorie_materiel::OrderBy('libelleCatMat')->get();
        $categories_limit = Categorie_materiel::take(9)->get();
        $materiels_tendance = Materiel::Where('popular_mat',1)->take(25)->get();
        $marques = Marque::OrderBy('nom')->get();
        return view('frontend.index', [
            'articles_dernier' => $articles_dernier,
            'categories' => $categories,
            'categories_limit' => $categories_limit,
            'tendances' => $materiels_tendance,
            'marques' => $marques
        ]);
    }


    public function categorie(){
        $categorie = Categorie_materiel::OrderBy('libelleCatMat')->paginate(28);
        return view('frontend.categorie',[
            'categorie' => $categorie
        ]);
    }

    public  function AllMateriel()
    {
        $categories = Categorie_materiel::All();
        $materiels = Materiel::OrderByDESC('created_at')->paginate(28);

        $count_mat = Materiel::All()->count();

        return view('frontend.materiels.allmateriels',[
            'categories' => $categories,
            'materiels' => $materiels,
            'count' => $count_mat
        ]);
    }

    public function Tendance()
    {
        $categories = Categorie_materiel::All();
        $materiels = Materiel::Where('popular_mat',1)->OrderByDESC('created_at')->paginate(28);

        $count_mat = Materiel::Where('popular_mat',1)->count();

        return view('frontend.materiels.tendance',[
            'categories' => $categories,
            'materiels' => $materiels,
            'count' => $count_mat
        ]);
    }

    public function TendanceCategorie($libelle)
    {
        $categorie = Categorie_materiel::where('libelleCatMat', $libelle)->first();
        $categories = Categorie_materiel::All();
        $materiels = Materiel::Where('popular_mat',1)->OrderByDESC('created_at')->where('categorie_materiel_id', $categorie -> id)->paginate(28);

        $count_mat = Materiel::Where('popular_mat',1)->where('categorie_materiel_id', $categorie -> id)->count();

        return view('frontend.materiels.tendanceclickcategorie',[
            'categories' => $categories,
            'materiels' => $materiels,
            'count' => $count_mat,
            'libelle' => $libelle
        ]);
    }

    public function clickcategorie($lib){
        if(Categorie_materiel::where('libelleCatMat',$lib)->exists()){
            $categorie= Categorie_materiel::where('libelleCatMat',$lib)->first();
            $categories = Categorie_materiel::OrderBy('libelleCatMat')->get();

            $materiels = Materiel::where('categorie_materiel_id',$categorie->id)->paginate(28);

            $count_mat = Materiel::where('categorie_materiel_id', $categorie->id)->count();

            return view('frontend.materiels.index',[
                'categories' => $categories,
                'materiels' => $materiels,
                'count' => $count_mat,
                'libelle' => $lib
            ]);
        }
        else{
            return redirect('/categorie')->with('echec','Categorie de materiel non trouvée');
        }
    }

    public function clickmateriel($lib, $id){
        //verifie si l'utilisateur a deja fait passer une commannde sur le materiel et que cette commande est complet
        $verif_user_achat = Commande::where('commandes.user_id', Auth::id())->where('statut','1')
            ->join('item_cmds','commandes.id','item_cmds.cmd_id')
            ->where('item_cmds.mat_id', $id)->get();
        $ok = 0;
        if($verif_user_achat -> count() > 0){
            $ok = 1;
        }

        //nombre de commentaire
        $nb_commentaire = Taux::where('materiel_id', $id)->get();
        $nb_cmt = $nb_commentaire -> count();

        

        //verifie si l'utilisateur a déja noté une fois le materiel
        $exist_note_user = Taux::where('user_id', Auth::id())->where('materiel_id', $id)->exists();
        $exist_note = 0;
        if($exist_note_user){
            $exist_note = 1;
        }

        if(Categorie_materiel::where('libelleCatMat',$lib)->exists()){
            if(Materiel::where('id',$id)->exists()){
                $materiel = Materiel::where('id',$id)->first();
                $note = Taux::where('user_id',Auth::id())->where('materiel_id',$id)->exists();
                if($note){
                    $note = Taux::where('user_id',Auth::id())->where('materiel_id',$id)->first();
                }else{
                    $note = '';
                }
                $notes_limit = Taux::OrderByDESC('updated_at')->where('materiel_id',$id)->take(3)->get();
                $notes = Taux::OrderBy('updated_at')->where('materiel_id',$id)->get();
                $notes_sum = Taux::where('materiel_id',$id)->sum('note');
                if($notes -> count()>0){
                    $note_moy = $notes_sum / $notes -> count();
                }else{
                    $note_moy =0;
                }
                return view('frontend.materiels.viewmateriel', compact('materiel','notes_limit', 'nb_cmt', 'note', 'note_moy', 'notes', 'ok', 'exist_note'));
            }else{
                return redirect('/categorie/'.$lib)->with('status','Materiel non trouvée');
            }
        }else{
            return redirect('/categorie')->with('status','Categorie de materiel non trouvée');
        }
    }

    //Rechercher....... materiel, marque
    public function listMatAjax()
    {
        $materiels = Materiel::select('tag')->get();
        $data=[];
        foreach ($materiels as $item ) {
            $data[] = $item['tag'];
        }
        return $data;
    }
    public function rechercheMateriel(Request $request)
    {
        $request -> validate([
            'search' => 'required'
        ]);
        $search = $request -> search;
        if($search == ""){
            return redirect()->back();
        }else{
            $materiels = Materiel::where('tag','LIKE', "%$search%")->paginate(28);
            $materiels -> appends($request->all());
            $marques = Marque::OrderBy('id')->get();
            $count = Materiel::where('tag','LIKE', "%$search%")->get();

            $categories = Categorie_materiel::OrderBy('libelleCatMat')->get();
            if($materiels -> count() > 0){
                return view('frontend.materiels.searchmateriel',[
                    'materiels' => $materiels,
                    'search' => $search,
                    'marques' => $marques,
                    'categories' => $categories,
                    'count' => $count
                ]);
            }else{
                return redirect()->back()->with('echec','Pas de materiel a ce nom');
            }
        }

    }
    public function searchClickCat($libelle,$search)
    {
        $categories = Categorie_materiel::OrderBy('libelleCatMat')->get();
        $categorie = Categorie_materiel::where('libelleCatMat', $libelle)->first();
        $marques = Marque::OrderBy('nom')->get();
        
        $count = Materiel::where('categorie_materiel_id', $categorie->id)->where('tag','LIKE', "%$search%")->get();

        $materiels = Materiel::where('categorie_materiel_id', $categorie->id)->where('tag','LIKE', "%$search%")->paginate(28);
        return view('frontend.materiels.searchmateriel',[
            'search' => $search,
            'materiels' => $materiels,
            'categories' => $categories,
            'marques' => $marques,
            'count' => $count
        ]);
    }

    public function searchClickMak($nom,$search)
    {
        $categories = Categorie_materiel::OrderBy('libelleCatMat')->get();
        $marques = Marque::OrderBy('nom')->get();
        $marque = Marque::where('nom', $nom)->first();
        
        $count = Materiel::where('marque_id', $marque->id)->where('tag','LIKE', "%$search%")->get();

        $materiels = Materiel::where('marque_id', $marque->id)->where('tag','LIKE', "%$search%")->paginate(28);
        return view('frontend.materiels.searchmateriel',[
            'search' => $search,
            'materiels' => $materiels,
            'categories' => $categories,
            'marques' => $marques,
            'count' => $count
        ]);
    }
    public function marques()
    {
        $marques = Marque::OrderBy('nom')->paginate(28);
        return view('frontend.marque',compact('marques'));
    }

    public function searchMarque($marque)
    {
        $count = Materiel::where('marque_id', $marque)->count();

        $marq = Marque::where('id',$marque)->first();

        $materiels = Materiel::where('marque_id', $marque)->paginate(28);
        $materiels -> appends($marque);
        $categories = Categorie_materiel::OrderBy('libelleCatMat')->get();
        return view('frontend.materiels.searchmarque',[
            'marque' => $marq,
            'materiels' => $materiels,
            'categories' => $categories,
            'count' => $count
        ]);
    }
    public function searchClickMarque($marque, $nom_categorie)
    {
        $categorie = Categorie_materiel::where('libelleCatMat',$nom_categorie)->first();
        $categories = Categorie_materiel::OrderBy('libelleCatMat')->get();

        $marq = Marque::where('id',$marque)->first();

        $count = Materiel::where('categorie_materiel_id', $categorie -> id)->where('marque_id', $marque)->count();

        $materiels = Materiel::where('categorie_materiel_id', $categorie -> id)->where('marque_id', $marque)->paginate(28);
        $materiels -> appends($marque);
        return view('frontend.materiels.searchmarque',[
            'marque' => $marq,
            'materiels' => $materiels,
            'categories' => $categories,
            'count' => $count
        ]);
    }

    //paramettre
    public function paramettre()
    {
        $us = User::where('id', Auth::id())->exists();
        if($us)
        {
            return view('frontend.paramettre.infos');
        }else{
            return redirect('/login');
        }
    }

    public function modifieInfos(Request $request)
    {
        $request ->validate([
            'nom' => 'required',
            'pnom' => 'required',
            'tel' => 'required',
            'adrss1' => 'required',
            'adrss2' => 'required',
            'ville' => 'required',
            'quartier' => 'required',
            'codepin' => 'required',
            'mdp' => 'required|min:8',
        ]); 
        $confirmation = User::where('id',Auth::id())->where('mdp', $request->mdp)->exists();
        if($confirmation)
        {
            User::where('id', Auth::id())->update([
                'name' => $request -> nom,
                'pnom' => $request -> pnom,
                'tel' => $request -> tel,
                'adrss1' => $request -> adrss1,
                'adrss2' => $request -> adrss2,
                'ville' => $request -> ville,
                'quartier' => $request -> quartier,
                'codepin' => $request -> codepin,
            ]);
            return redirect('/')->with('status','Données personnelles modifié avec succès');
        }else{
            return redirect('/profil')->with('echec','Mot de passe incorrect');
        }
    }

    public function modifieMdp(Request $request)
    {
        $request -> validate([
            'mdpa' => 'required|min:8',
            'mdpn' => 'required|min:8',
            'mdpc' => 'required|min:8',
        ]);
        $confirmation = User::where('id', Auth::id())->where('mdp', $request ->mdpa)->exists();
        if($confirmation)
        {
            if($request ->mdpn === $request ->mdpc)
            {
                User::where('id', Auth::id())->update([
                    'password' => Hash::make($request ->mdpn),
                    'mdp' => $request ->mdpn,
                ]);
                return redirect('/')->with('status','Mot de passe modifié avec succès');
            }else{
                return redirect('/profil')->with('echec','Nouveau mot de passe et confirmation non identique');
            }
        }else{
            return redirect('/profil')->with('echec','Ancien mot de pass non valide');
        }
    }

    public function Apropos()
    {
        return view('frontend.propos');
    }
    
}
