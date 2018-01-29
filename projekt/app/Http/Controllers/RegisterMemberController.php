<?php

namespace App\Http\Controllers;

use App\User;
use App\GroupConnect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RegisterMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	if(Auth::check() && Auth::user()->is_admin == true){
            $groups = DB::table('groups')
            ->select('groups.id', 'groups.name')
            ->get();
    		return view('vytvor-clena', ['groups' => $groups]);
    	}
    	return redirect('/');
    }

    public function add(Request $request)
    {
        if(Input::get("skupina")=="vyber")
            return back()->withErrors(['Status' => 'Musíte vybrať skupinu.']);

        $this->validate($request,[
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'nullable|email|unique:users|max:255',
            'tel' => 'max:255',
            'password' => 'required|string|min:6',
            'skupina' => 'required|max:255'
        ]);

        $user = new User;
        $user->firstname = Input::get("firstname");
        $user->lastname = Input::get("lastname");
        $user->email = Input::get("email");
        $user->tel = Input::get("tel");
        $user->username = Input::get("username");
        $user->image_path = "img/profil.jpg";
        $user->password = bcrypt(Input::get("password"));
        $user->is_admin = false;
        $user->save();

        $gc = new GroupConnect;
        $gc->user_id = $user->id;
        $gc->group_id = Input::get("skupina");
        $gc->group_connection = true;
        $gc->save();

        return redirect('/profil')->with('Status','OK');
    }
}
