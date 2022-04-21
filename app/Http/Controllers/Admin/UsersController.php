<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_as == '2')
        {
            $users = User::where('role_as','0')->OrderByDESC('created_at')->get();
            return view('admin.user.index',[
                'users' => $users
            ]);
        }
        else {
            return redirect('/dashboard');
        }
        
    }


    public function voirUser($id)
    {
        if(Auth::user()->role_as == '2')
        {
            $user = User::where('id', $id)->first();
            return view('admin.user.voirUser',[
                'user' => $user
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function employes()
    {
        if(Auth::user()->role_as == '2')
        {
            $users = User::where('role_as','1')->OrderByDESC('created_at')->get();
            return view('admin.user.employes',[
                'users' => $users
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function ajout()
    {
        if (Auth::user()->role_as == '2') {
            return view('admin.user.ajout');
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function insert(Request $request)
    {
        if (Auth::user()->role_as == '2') {
            $request->validate([
                'nom' => 'required',
                'pnoms' => 'required',
                'email' => 'required|unique:user,email',
                'mdp' => 'required|min:8',
                'cmdp' => 'required',
            ]);

            if($request->mdp != $request->cmdp)
            {
                return redirect('/ajout-employes')->with('echec','Les mot de passe ne correspond pas');
            }
            else
            {
                if(User::where('email',$request->email)->exists())
                {
                    return redirect('/ajout-employes')->with('echec','Mail existant déja!');
                }
                else
                {
                    $role = 1;
                    User::create([
                        'name' => $request->nom,
                        'pnom' => $request->pnoms,
                        'email' => $request->email,
                        'mdp' =>$request->mdp,
                        'tel' =>'',
                        'adrss1' =>'',
                        'adrss2' =>'',
                        'ville' =>'',
                        'quartier' =>'',
                        'codepin' =>'',
                        'role_as' =>'',
                        'password' => Hash::make($request->mdp),
                    ]);
                    User::where('email', $request->email)->update([
                        'role_as' =>$role,
                    ]);
                    return redirect('/employes')->with('status','Employé ajouté avec succès !');
                }
            }
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function detroy($id)
    {
        if (Auth::user()->role_as == '2') {
            User::where('id',$id)->where('role_as','1')->delete();
            redirect('/employes')->with('status','Employés supprimé avec succès');
        }else
        {
            return redirect('/dashboard');
        }
    }
}
