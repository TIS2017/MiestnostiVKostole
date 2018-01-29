<?php

namespace App\Http\Controllers;

use App\Group;
use App\Subadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class RegisterGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	if(Auth::check() && Auth::user()->is_admin == true){
            $users = DB::table('users')
            ->select('users.id', 'users.firstname', 'users.lastname')
            ->get();
    		return view('vytvor-skupinu', ['users' => $users]);
    	}
    	return redirect('/');
    }

    public function add(Request $request)
    {
        if(Input::get("subadmin")=="vyber")
            return back()->withErrors(['Status' => 'Musíte vybrať meno vedúceho.']);

        $this->validate($request,[
            'name' => 'required|unique:groups|max:255',
            'subadmin' => 'required|max:255'
        ]);

        $group = new Group;
        $group->name = Input::get("name");
        $group->save();

        $subadmin = new Subadmin;
        $subadmin->group_id = $group->id;
        $subadmin->subadmin_id = Input::get("subadmin");
        $subadmin->save();

        return redirect('/profil')->with('Skupina','OK');
    }
}
