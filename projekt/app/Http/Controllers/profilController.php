<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class profilController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show(){

    	$mygroups = DB::table('users')
        ->join('group_connects', 'group_connects.user_id', '=', 'users.id')
        ->join('groups', 'group_connects.group_id', '=', 'groups.id')
        ->select('groups.name')
        ->where('users.firstname', '=', '{{ Auth::user()->firstname}}')
        ->where('users.lastname', '=', '{{ Auth::user()->lastname}}')
        ->get();
        
    	return view('profil')->with('mygroups',$mygroups);
    }
}
