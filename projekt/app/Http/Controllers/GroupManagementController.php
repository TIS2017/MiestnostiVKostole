<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Date;
use App\Meeting;
use App\GroupConnect;
use App\Subadmin;

class GroupManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($groupname)
    {
    	if(Auth::check() && Auth::user()->is_admin == true)
        {
            $members = DB::table('users')
                    ->join('group_connects', 'group_connects.user_id', '=', 'users.id')
                    ->join('groups', 'group_connects.group_id', '=', 'groups.id')
                    ->select('users.firstname as firstname', 'users.lastname as lastname', 'users.tel as tel', 'users.email as email')
                    ->where('groups.name', '=', $groupname)
                    ->where('group_connects.group_connection','=', true)
                    ->get();

            $subadmins = DB::table('subadmins')
                    ->join('users', 'subadmins.subadmin_id', '=', 'users.id')
                    ->join('groups', 'subadmins.group_id', '=', 'groups.id')
                    ->select('users.firstname as firstname', 'users.lastname as lastname', 'users.tel as tel', 'users.email as email')
                    ->where('groups.name', '=', $groupname)
                    ->get();

            $rooms = DB::table('rooms')
                    ->select('rooms.id as id', 'rooms.name as name')
                    ->where('is_available','=',true)
                    ->get();

            $group = DB::table('groups')
                    ->where('groups.name', '=', $groupname)
                    ->count();

            $users = DB::table('users')
                    ->select('users.id', 'users.firstname', 'users.lastname')
                    ->get();

            $requests = DB::table('meetings')
                        ->join('dates', 'meetings.date_id', '=', 'dates.id')
                        ->join('rooms', 'rooms.id', '=', 'meetings.room_id')
                        ->select('rooms.name as room', 'dates.time as time', 'meetings.id as meeting_id')
                        ->where('meetings.is_approved', '=', false)
                        ->where('meetings.group_id', '=', $this->getGroupId($groupname))
                        ->get();

            //skupina neexistuje
            if($group == 0)
                return abort(404);
            else
    		    return view('sprava-skupin',['members' => $members, 'groupname'=> $groupname, 'rooms' => $rooms, 'users' => $users, 'requests' => $requests,'subadmins' => $subadmins]);
    	}
        //nie je admin
    	return abort(404);
    }

    public function addRoom(Request $request, $groupname)
    {
        if(Input::get("room")=="vyber" || Input::get("day")=="vyber" || Input::get("time")=="vyber")
            return back()->withInput()->withErrors(['Status' => 'Nie sú vyplnené všetky údaje.']);

        $is_free = DB::table('meetings')
                    ->join('rooms', 'rooms.id', '=', 'meetings.room_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->where('dates.day', '=', $request->input('day'))
                    ->where('dates.time', '=', $request->input('time'))
                    ->where('rooms.id', '=', $request->input('room'))
                    ->count();

        if($is_free > 0)
        {
            return back()->withInput()->withErrors(['Status' => 'Miestnosť je obsadená.']);
        }
        else
        {
            $group_id = $this->getGroupId($groupname);
            $date = new Date;
            $date->day = Input::get("day");
            $date->week = 1;   //uplne zbytocne, zmazat tento stlpec z db
            $date->month = 1; //tak isto
            $date->year = 1; //aj tu
            $date->time = Input::get("time");
            $date->duration = 60; //tiez zbytocne
            $date->save();

            $meeting = new Meeting;
            $meeting->date_id = $date->id;
            $meeting->room_id = Input::get("room");
            $meeting->group_id = $group_id; 
            $meeting->repeat = 7;  // tu je tiez na nic zatial
            $meeting->is_approved = true;
            $meeting->save();

            return back()->with('status', 'OK');
        }
    }

    public function addMember($groupname)
    {
        if(Input::get("name")=="vyber" || Input::get("type")=="vyber")
            return back()->withInput()->withErrors(['Status' => 'Nie sú vyplnené všetky údaje.']);

        $is_subadmin = DB::table('groups')
                        ->join('subadmins', 'subadmins.group_id', '=','groups.id')
                        ->where('groups.name','=', $groupname)
                        ->where('subadmins.subadmin_id', '=', Input::get("name"))
                        ->count();

        $is_member = DB::table('group_connects')
                        ->join('groups', 'group_connects.group_id', '=', 'groups.id')
                        ->where('groups.name', '=', $groupname)
                        ->where('group_connects.user_id', '=', Input::get("name"))
                        ->count();

        if(Input::get("type") == 1)
        {
            if($is_member > 0)
                return back()->withInput()->withErrors(['Status' => 'Vybraný používateľ je už členom tejto skupiny.']);
            else
            {
                //ak je naduzivatelom, tak sa mu zrusia prava
                if($is_subadmin > 0)
                {
                    $id = \App\Subadmin::where('subadmin_id',Input::get("name"))->first()->id;
                    \App\Subadmin::destroy($id);
                }
                $group_id = $this->getGroupId($groupname);
                $gc = new GroupConnect;
                $gc->user_id = Input::get("name");
                $gc->group_id = $group_id;
                $gc->group_connection = true;
                $gc->save();

                return back()->with('StatusMember', 'OK');
            }
        }
        else if(Input::get("type") == 2)
        {
            if($is_subadmin > 0)
                return back()->withInput()->withErrors(['Status' => 'Vybraný používateľ je už nadužívateľom tejto skupiny.']);
            else
            {
                if($is_member > 0){
                    $id = \App\GroupConnect::where('user_id',Input::get("name"))->first()->id;
                    \App\GroupConnect::destroy($id);
                }
                $group_id = $this->getGroupId($groupname);
                $subadmin = new Subadmin;
                $subadmin->group_id = $group_id;
                $subadmin->subadmin_id = Input::get("name");
                $subadmin->save();

                return back()->with('StatusSubadmin', 'OK');
            }
        }
        else if(Input::get("type") == 3)
        {   
            $is_admin = DB::table('users')
                        ->where('users.id', '=', Input::get("name"))
                        ->where('users.is_admin','=',true)
                        ->count();

            if($is_admin > 0)
                return back()->withInput()->withErrors(['Status' => 'Vybraný používateľ je už administrátor.']);
            else
            {
                $user = \App\User::find(Input::get("name"));
                $user->is_admin = true;
                $user->save();
                return back()->with('StatusAdmin', 'OK');
            }
        }
    }

    public function confirmRequest($groupname, $request){
        $m = \App\Meeting::find($request);
        $m->is_approved = true;
        $m->save();
        return back();
    }

    public function deleteRequest($groupname, $request){
        $id_date = \App\Meeting::find($request)->date_id;
        \App\Date::destroy($id_date);
        \App\Meeting::destroy($request);
        return back();
    }

    public function getGroupId($groupname)
    {
        return \App\Group::where('name',$groupname)->first()->id;
    }

    public function showError(){
        return abort(404);
    }
}
