<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Date;
use App\Room;
use App\Meeting;
use App\Group;
use App\User;


class ReservationController extends Controller
{

public function add(Request $request){

    $this->validate($request,[
        'interval' => 'required',
        'userid' => 'required',
        'group_selected' => 'required'
        ]);

    //Get current time data
    $current = new Carbon();
    $week = $current->weekOfYear;
    $year = $current->year;
    $month = $current->month;

    //Day map
    $collection = $this->days();

    //Form values
    $od = Input::get('od');
    $od2 = Input::get('od2');

    $day = $collection->get(Input::get('den'));
    $day2 = $collection->get(Input::get('den2'));

    $groupname = Input::get('group_selected');

    $roomname = Input::get('roomname');
    $selected_room = Input::get('room_selected');

    $userid = Input::get('userid');
    $interval = Input::get('interval');

    DB::beginTransaction();
    $status = true;

    //Room and Date instance acording to filter
    if($roomname != 'undefined'){
        $room = $this->getTheRoom($roomname);
        $date = $this->CreateDate($day, $week, $month, $year, $od);
    }
    else{
        $room = $this->getTheRoom($selected_room);
        $date = $this->CreateDate($day2, $week, $month, $year, $od2);
    }

    //Group instance
    if($groupname != null){
        $group = Group::where('name', $groupname)->first();
    }
    else{
        $group = $this->getTheGroup($userid);
    }

    //decide that opakovane or jednorazove
    if($interval == 1){
        $r_interval = 1;
    }
    else{
        $r_interval = 7;
    }

    
    $meeting = $this->CreateMeeting($date->id,$room->id,$group->id,$r_interval);
        
    //DEBUG
    //dd("DATE: ".$date. "  ROOM: ".$room. "  GROUP: ".$group. "  MEETING: ".$meeting);

       //if there is a meeting blacklisted in same time...
    $test = DB::table('meetings')
    ->join('dates', 'dates.id','meetings.date_id')
    ->join('rooms', 'rooms.id', '=', 'meetings.room_id')
    ->where('blacklisted', '=', true)
    ->where('rooms.id','=',$room->id)
    ->select('dates.day','dates.year','dates.time','dates.month','dates.year','dates.week')
    ->get();

    if($test->count() > 0){
        foreach($test as $item){
            if ($item->day == $date->day && $item->year == $date->year && $item->time == $date->time && $item->month == $date->month && $item->week == $date->week && $r_interval == 7){
                $status = false;
                DB::rollBack();
            }
            else{
                $status = true;
                DB::commit();
            }
        }
    }
    else{
        $status = true;
        DB::commit();
    }

    if($roomname != 'undefined'){
        if($status){
            return redirect('/miestnost/filter')->with('room',$roomname)->with('Status','OK');
        }
        else{
            return redirect('/miestnost/filter')->with('room',$roomname)->with('Error','Error');
        }
    }
    else{
        if($status){
            return redirect('/cas/filter')->with('day',$day2)->with('from',Input::get('from'))->with('to',Input::get('to'))->with('Status','OK');
        }
        else{
            return redirect('/cas/filter')->with('day',$day2)->with('from',Input::get('from'))->with('to',Input::get('to'))->with('Error','Error');
        }
    }
}
    
    public function CreateMeeting(String $d_id, String $r_id, String $g_id, String $interval){
        //Meeting values
        $meeting = new Meeting;
        $meeting->date_id = $d_id;
        $meeting->room_id = $r_id;
        $meeting->group_id = $g_id;
        $meeting->repeat = $interval;
        if(Auth::user()->is_admin)
            $meeting->is_approved = true;
        else    
            $meeting->is_approved = false;
        $meeting->blacklisted = false;
        $meeting->save();

        return $meeting;
    }

    public function getTheGroup(String $userid){
        $user = User::findOrFail($userid);
        $grp =  DB::table('groups')
                ->join('subadmins','subadmins.group_id','groups.id')
                ->where('subadmin_id','=',$user->id)
                ->get();
        return $grp;
    }

    public function getTheRoom(String $roomname){
        $rm = Room::where('name', $roomname)->first();
        return $rm;
    }

    public function show(){
        return redirect()->back()->with('success', ['Pridane']);   
    }

    public function days(){
    	$collection = collect([
            'Pondelok' => '1',
            'Utorok' => '2',
            'Streda' => '3',
            'Štvrtok' => '4',
            'Piatok' => '5',
            'Sobota' => '6',
            'Nedeľa' => '7',
        ]);
        return $collection;
    }

    public function remove(Request $request){
        $meetingid = Input::get('meetingid');
        $meet = Meeting::where('id',$meetingid)->first(); // meeting instance
        $id = $meet->id;

        $interval = Input::get('interval'); //user choosen mode to delete
        $meeting_type = $meet->repeat; // get the type of the chosen meeting

        if($interval == 1){ // delete only once
            $this->deleteOnce($meeting_type,$id);
        }
        elseif($interval == 2){
            $this->deleteAll($id);
        }

        return redirect('/skupina/filter')->with('groupname', Input::get('groupname'))->with('Remove','OK');
    }

    public function deleteOnce(String $type, String $id){
        if($type == 7){
        //Delete repeatable meeting only in this week, blacklisted = true ===> not listed in filter
            DB::table('meetings')->where('id', $id)->update(['blacklisted' => true]);
        }
        elseif($type == 1){
            //delete single meeting only once
            $this->deleteAll($id);
        }

    }

    public function deleteAll(String $id){
        $meeting = Meeting::find($id);
        $date = Date::find($meeting->date_id);

        $meeting->delete();
        $date->delete();
    }

    public function CreateDate(String $day, String $week, String $month, String $year, String $od){
        //Date Table values
        $date = new Date;
        $date->day = $day;
        $date->week = $week;
        $date->month = $month;
        $date->year = $year;
        $date->time = $od;
        $date->duration = 60;
        $date->save();

        return $date;
    }

}
