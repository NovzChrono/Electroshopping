<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Commande;
use App\Models\Item_cmd;
use App\Models\Materiel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class FontendController extends Controller
{
    //sur le dashboard
    public function index(){
        $commandes = Commande::where('date', date('y-m-d'))->get();
        $cmd_count = $commandes -> count();

        $user = User::where('created_at','>',date('y-m-d, 0:0:0'))->where('created_at','<',date('y-m-d, 23:59:59'))->get();
        $user_count = $user -> count();

        $commande_no_complete = Commande::where('statut','0') -> get();
        $cmd_no_complete = $commande_no_complete -> count();

        /*$materiel_rupture = Materiel::where('qte_mat','0')->get();
        $mat_rup_count = $materiel_rupture -> count();*/

        $materiel_rup_presque = Materiel::where('qte_mat','<','10')->get();
        $mat_pres_count = $materiel_rup_presque -> count();

        //chart js commandes par jours
        $data = Commande::Select('id','created_at')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('j-n-y');
        });

        $joursCmd =[];
        $joursCountcmd = [];
        foreach ($data as $jour => $valeurs) {
            $joursCmd[] = $jour;
            $joursCountCmd[] =count($valeurs);
        }


        //chart js Users par jours
        $data = User::Select('id','created_at')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('j-n-y');
        });

        $joursUser =[];
        $joursCountUser = [];
        foreach ($data as $jour => $valeurs) {
            $joursUser[] = $jour;
            $joursCountUser[] =count($valeurs);
        }

        return view('admin.index', [
            'cmd' => $cmd_count,
            'user' => $user_count,
            'cmd_NoCpt' => $cmd_no_complete,
            'mat_pres' => $mat_pres_count,
            'data' => $data,
            'joursCmd' => $joursCmd,
            'joursCountCmd' => $joursCountCmd,
            'joursUser' => $joursUser,
            'joursCountUser' => $joursCountUser
        ]);
    }


    public function cmdDay()
    {
        $commandes = Commande::where('date',date('y-m-d'))->get();
        return view('admin.dashboard.commandesJour',compact('commandes'));
    }

    public function userDay(){
        $users = User::where('created_at','>',date('y-m-d, 0:0:0'))->where('created_at','<',date('y-m-d, 23:59:59'))->get();
        return view('admin.dashboard.usersJour',compact('users'));
    }


    public function cmdNoC()
    {
        $commandes = Commande::where('statut','0') -> get();
        return view('admin.dashboard.commandesNop',compact('commandes'));
    }


    public function cmdRupture()
    {
        $materiel = Materiel::where('qte_mat','<','10')->get();
        return view('admin.dashboard.materielsRupture',compact('materiel'));
    }

    //recherche sur la suivie
    public function listSuivAjax()
    {
        $cmds = Commande::select('suivie_nb')->get();
        $data=[];
        foreach ($cmds as $item ) {
            $data[] = $item['suivie_nb'];
        }
        return $data;
    }

    public function rechercheSuivie(Request $request)
    {
        $request -> validate([
            'search' => 'required'
        ]);
        $search = $request -> search;
        if($search == ""){
            return redirect('/dashboard');
        }else{
            $cmds = Commande::where('suivie_nb','LIKE', "%$search%")->OrderByDESC('created_at')->get();
            if($cmds -> count() > 0){
                return view('admin.searchSuivie',[
                    'cmds' => $cmds,
                    'search' => $search
                ]);
            }else{
                return redirect('/dashboard')->with('status','Pas de numero de suivie trouvé');
            }
        }

    }

    public function voirCommande($id)
    {
        $commande= Commande::where('id',$id)->first();
        $cmditem = Item_cmd::where('cmd_id',$id)->get();
        return view('admin.commande.cmdattente',[
            'cmd' =>  $commande,
            'items' => $cmditem
        ]);
    }

    //recherche sur le numero
    public function listTelAjax()
    {
        $cmds = Commande::select('tel')->get();
        $data=[];
        foreach ($cmds as $item ) {
            $data[] = $item['tel'];
        }
        return $data;
    }

    public function rechercheTel(Request $request)
    {
        $request -> validate([
            'searcht' => 'required'
        ]);

        $search = $request -> searcht;
        if($search == ""){
            return redirect('/dashboard');
        }else{
            $cmds = Commande::where('tel','LIKE', "%$search%")->OrderByDESC('created_at')->get();
            if($cmds -> count() > 0){
                return view('admin.searchTel',[
                    'cmds' => $cmds,
                    'search' => $search
                ]);
            }else{
                return redirect('/dashboard')->with('status','Pas de numéro trouvé');
            }
        }
    }

    //paramettre à terminer
    public function paramettre ()
    {
        $user = User::where('id', Auth::id())->first();
        return view('admin.paramettre.paramettre',compact('user'));
    }

    public function modifieCompte(Request $request)
    {
        $request -> validate([
            'nom' => 'required',
            'pnom' => 'required',
            'tel' => 'required',
            'adrss1' => 'required',
            'adrss2' => 'required',
            'quartier' => 'required',
            'ville' => 'required',
            'codepin' => 'required',
            'mdp' => 'required',

        ]);
        $confirmation = User::where('id', Auth::id())->where('mdp',$request -> mdp)->exists();
        if($confirmation)
        {
            User::where('id', Auth::id())->update([
                'name' => $request -> nom,
                'pnom' => $request -> pnom,
                'tel' => $request -> tel,
                'adrss1' => $request -> adrss1,
                'adrss2' => $request -> adrss2,
                'quartier' => $request -> quartier,
                'ville' => $request -> ville,
                'codepin' => $request -> codepin,
            ]);
            return redirect('/dashboard')->with('status','Données personnelles modifié avec succès');
        }else{
            return redirect('/compte_admin')->with('echec','Mot de passe saisi invalide');
        }
        
    }

    public function paramettrePwd()
    {
        return view('admin.paramettre.pwd');
    }

    public function modifiePwd(Request $request)
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
                return redirect('/dashboard')->with('status','Mot de passe modifié avec succès');
            }else{
                return redirect('/compte_pwd')->with('echec','Nouveau mot de passe et confirmation non identique');
            }
        }else{
            return redirect('/compte_pwd')->with('echec','Ancien mot de pass non valide');
        }
    }
}
