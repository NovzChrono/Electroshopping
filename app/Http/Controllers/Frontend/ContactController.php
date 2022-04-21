<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use App\Mail\MailHelp;

class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact');
    }
    public function store(Request $request)
    {   
        $request -> validate([
            'nom' => 'required',
            'mail' => 'required',
            'tel' => 'required',
            'objet' => 'required',
            'message' => 'required',
        ]);
        $user = ['nom' => $request->nom,'tel' => $request->tel, 'email' => $request->mail, 'message' => $request->message,'objet' => $request->objet];
        Mail::to($request->mail) ->send(new Contact($user));
        return redirect('/')->with('status','Mail envoyé avec success');
    }

}
