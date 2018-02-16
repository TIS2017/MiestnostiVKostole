<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\GroupConnect;
use App\Group;

class InfoController extends Controller
{
    public function showGroupInfo($groupname){
        
        $subadmin_data = DB::table('groups')
                    ->join('subadmins', 'subadmins.group_id', '=','groups.id')
					->join('users', 'subadmins.subadmin_id', '=', 'users.id')
                    ->select('groups.name as name', 'users.firstname as firstname', 'users.lastname as lastname', 'users.tel as tel', 'users.email as email')
                    ->where('groups.name', '=', $groupname)
                    ->get();

        $members = DB::table('users')
                    ->join('group_connects', 'group_connects.user_id', '=', 'users.id')
                    ->join('groups', 'group_connects.group_id', '=', 'groups.id')
                    ->select('users.firstname as firstname', 'users.lastname as lastname', 'users.tel as tel', 'users.email as email')
                    ->where('groups.name', '=', $groupname)
                    ->where('group_connects.group_connection','=', true)
                    ->get();


        if(Auth::check()){
            $is_subadmin = DB::table('groups')
                    ->join('subadmins', 'subadmins.group_id', '=','groups.id')
                    ->whereColumn([
                        ['groups.name', '=', $groupname],
                        ['subadmins.subadmin_id', '=', Auth::user()->id]
                    ])->count();

            $is_member = DB::table('groups')
                    ->join('group_connects', 'group_connects.group_id', '=', 'groups.id')
                    ->where('group_connects.user_id', '=', Auth::user()->id)
                    ->where('groups.name', '=', $groupname)
                    ->count();

            $requests = DB::table('users')
                        ->join('group_connects', 'group_connects.user_id', '=', 'users.id')
                        ->join('groups', 'group_connects.group_id', '=', 'groups.id')
                        ->join('subadmins', 'subadmins.group_id', '=','groups.id')
                        ->select('users.firstname as firstname', 'users.lastname as lastname', 'group_connects.id as group_id')
                        ->where('groups.name', '=', $groupname)
                        ->where('subadmins.subadmin_id', '=', Auth::user()->id)
                        ->where('group_connects.group_connection','=', false)
                        ->get();
        }
        else{
            $is_subadmin = 0;
            $is_member = 0;
            $requests = 0;
        }
        if($subadmin_data->count() == 0){
            return abort(404);
        }
        else        
            return View::make('udaje-o-skupine')->with('subadmin_data', $subadmin_data)->with('members', $members)->with('is_subadmin', $is_subadmin)->with('groupName',$groupname)->with('is_member',$is_member)->with('requests',$requests);
    }

    public function addNotification($groupname){
        $id_group = \App\Group::where('name',$groupname)->first()->id;
    
        $gc = new GroupConnect;
        $gc->user_id = Auth::user()->id;
        $gc->group_id = $id_group;
        $gc->group_connection = false; //este nie je potvrdena ziadost
        $gc->save();

        return redirect('/udaje-o-skupine/'.$groupname)->with('Status','OK');
    }

    public function confirmRequest($groupname, $request){
        $r = \App\GroupConnect::find($request);
        $r->group_connection = true;
        $r->save();
        return back();
    }

    public function deleteRequest($groupname, $request){
        \App\GroupConnect::destroy($request);
        return back();
    }

    public function showError(){
        return abort(404);
    }
}
