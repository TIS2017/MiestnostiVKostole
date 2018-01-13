<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	if(Auth::check() && Auth::user()->is_admin == true){
    		return view('vytvor-skupinu');
    	}
    	return redirect('/');
    }
}
