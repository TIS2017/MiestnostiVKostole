<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image; 
use File;

class profilController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show()
    {
    	$mygroups = DB::table('groups')
        ->join('group_connects', 'group_connects.group_id', '=', 'groups.id')
        ->join('meetings', 'meetings.group_id', '=', 'groups.id')
        ->join('dates', 'meetings.date_id', '=', 'dates.id')
        ->join('rooms', 'rooms.id', '=', 'meetings.room_id')
        ->select('rooms.name as room', 'dates.time as time', 'groups.name as group')
        ->where('group_connects.group_connection', '=', true)
        ->where('meetings.is_approved', '=', true)
        ->where('group_connects.user_id', '=', Auth::user()->id)
        ->get();

        $subadmin_groups = DB::table('groups')
        ->join('meetings', 'meetings.group_id', '=', 'groups.id')
        ->join('dates', 'meetings.date_id', '=', 'dates.id')
        ->join('rooms', 'rooms.id', '=', 'meetings.room_id')
        ->join('subadmins', 'groups.id', '=', 'subadmins.group_id')
        ->select('rooms.name as room', 'dates.time as time', 'groups.name as group')
        ->where('subadmins.subadmin_id', '=', Auth::user()->id)
        ->where('meetings.is_approved', '=', true)
        ->get();

        //skupiny pre naduzivatelov, ktore nemaju ziadnu rezervaciu miestnosti
        $subadminGroup = DB::table('groups')
                    ->leftjoin('meetings', 'meetings.group_id', '=', 'groups.id')
                    ->join('subadmins', 'groups.id', '=', 'subadmins.group_id')
                    ->select('groups.name as group')
                    ->where('meetings.group_id', '=', null)
                    ->where('subadmins.subadmin_id', '=', Auth::user()->id)
                    ->get();

        //zobrazenie skupin pre clenov, ktore nemaju ziadnu rezerv.
        $userGroup = DB::table('groups')
                    ->join('group_connects', 'group_connects.group_id', '=', 'groups.id')
                    ->leftjoin('meetings', 'meetings.group_id', '=', 'groups.id')
                    ->select('groups.name as group')
                    ->where('group_connects.group_connection', '=', true)
                    ->where('meetings.group_id', '=', null)
                    ->where('group_connects.user_id', '=', Auth::user()->id)
                    ->get();

        if(Auth::user()->is_admin == true){
            $groups = DB::table('groups')
                ->select('groups.name as name','groups.id as id')
                ->get();
        }
        else
            $groups = 0;

    	return view('profil')->with('mygroups',$mygroups)->with('subadminGroups',$subadmin_groups)->with('allgroups', $groups)->with('subadminGroup',$subadminGroup)->with('userGroup',$userGroup);
    }

    public function showForm()
    {
        $user = DB::table('users')
        ->select('users.firstname','users.lastname','users.email','users.tel','users.username', 'users.image_path')
        ->where('users.id', '=', Auth::user()->id)
        ->get();

        return view('uprava')->with('user',$user);
    }

    public function updateData(Request $request)
    {
        $this->validate($request,[
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'tel' => 'max:255',
            'file' => 'image|mimes:jpg,jpeg,png,bmp,svg'
        ]);

        $user = \App\User::find(Auth::user()->id);
        $user->firstname = Input::get("firstname");
        $user->lastname = Input::get("lastname");
        $user->email = Input::get("email");
        $user->tel = Input::get("tel");
        $user->username = Input::get("username");

        if(Input::hasFile('file'))
        {
            File::delete(Auth::user()->image_path);
            $file = Input::file('file');
            $filename = $file->hashName();
            $path = public_path().'/uploads/'.$filename;
            Image::make($file->getRealPath())->resize(200, 200)->save($path);
            $user->image_path = 'uploads/'.$filename;
        }
        $user->save();

        return redirect('profil')->with('Update','OK');;
    }

    public function deleteGroup($groupid)
    {
        $g = \App\Group::find($groupid)->delete();
        return back();
    }

    public function updatePassword(Request $request)
    {
        if(strlen(Input::get('password')) < 6)
            return back()->with('MinPass','Err');

        if (Hash::check(Input::get('old_password'), Auth::user()->password)) { 
            $user = \App\User::find(Auth::user()->id);
            $user->password = bcrypt(Input::get("password"));
            $user->save();
            return back()->with('Succes','OK');
        }
        else
            return back()->with('Status','Err');
    }

    public function showError(){
        abort(404);
    }
}
