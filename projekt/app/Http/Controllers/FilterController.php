<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Room;
use App\Group;
use DateTime;

class FilterController extends Controller
{
	public function showTime(){
		return view('cas');
	}

    public function filterTime(Request $request){

        $post = $request;
        $collection = $this->days();
        $items = \App\Room::where('is_available',true)->get();
        $from = $request->input('od');
        $to = $request->input('do');
        $magicday = $request->input('den');
        if($magicday=="vyber")
            $magicday = 1; //default pondelok

        if(session('day'))
            $magicday = session('day');
        if(session('from'))
            $from = session('from');
        if(session('to'))
            $to = session('to');

		$result = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('groups', 'groups.id', '=', 'meetings.group_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->select('rooms.name as room', 'dates.time as time', 'groups.name as group', 'dates.day as day')
                    ->where('meetings.is_approved', '=', true)
                    ->where('dates.day', '=', $magicday)
                    ->where('dates.time', '>=', $from)
                    ->where('dates.time', '<', $to)
                    ->where('meetings.blacklisted', '=', false)
                    ->get();

        $is_subadmin = $this->is_subadmin();
        $t = $this->timesForFilterTime();

        if($is_subadmin){
            $groups = DB::table('groups')
                                ->join('subadmins','subadmins.group_id','groups.id')
                                ->where('subadmin_id','=',Auth::user()->id)
                                ->get();
        }
        else if(Auth::check() && Auth::user()->is_admin == true)
        {
            $groups = DB::table('groups')->get();
        }
        else
        {
            $groups = null;
        }
       
        $filtered = $t->filter(function ($value, $key) use ($from,$to) {
            return $value >= $from && $value <= $to;
        });

        $chosenday = $collection->get($magicday);
        return View::make('cas')
        ->with('id_day',$magicday)
        ->with('times',$result)
        ->with('to',$to)
        ->with('from',$from)
        ->with('collect',$collection)
        ->with('day',$chosenday)
        ->with('roomlist', $items)
        ->with('postdata', $post)
        ->with('is_subadmin',$is_subadmin)
        ->with('groups',$groups)
        ->with('filtered_time',$filtered);

    }

    public function days(){
    	$collection = collect([
            '1' => 'Pondelok',
            '2' => 'Utorok',
            '3' => 'Streda',
            '4' => 'Štvrtok',
            '5' => 'Piatok',
            '6' => 'Sobota',
            '7' => 'Nedeľa',
        ]);
        return $collection;
    }
    public function times(){
    	$times = collect();
    	for($i = 8; $i< 24;$i++){
    		if($i<10)
    			$times->put($i, "0$i:00");
    		else
    			$times->put($i, "$i:00");
    	}
    	return $times;
    }
    public function timesForFilterTime(){
        $times = collect();
        for($i = 8; $i< 25;$i++){
            if($i<10)
                $times->put($i, "0$i:00");
            else
                $times->put($i, "$i:00");
        }
        return $times;
    }

    public function is_subadmin(){
    	if(Auth::check()){
			$is_subadmin = DB::table('groups')
                        ->join('subadmins', 'subadmins.group_id', '=','groups.id')
						->where('subadmins.subadmin_id', '=', Auth::user()->id)
	                   	->count();
	    }
	    else
	    	$is_subadmin = 0;
	    return $is_subadmin;
    }

    public function filterRoom(Request $request){

    	if(Input::get("room")=="vyber")
            return back()->withErrors(['Status' => 'Nezadali ste žiadnu miestnosť.']);

        $magicRoom = $request->input('room');
        $items = $this->getRooms();
        $collection = $this->days();
        $collectionTimes = $this->times(); 
        if(session('room'))
            $magicRoom = session('room');
		
		$result = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('groups', 'groups.id', '=', 'meetings.group_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->select('dates.time as time', 'groups.name as group', DB::raw("time(strftime('%s', dates.time) + dates.duration * 60,  'unixepoch') as end_time"), 'dates.day as day')
                    ->where('meetings.is_approved', '=', true)
                    ->where('rooms.name', '=', $magicRoom)
                    ->where('meetings.blacklisted', '=', false)
					->get();

		
	    $is_subadmin = $this->is_subadmin();

        if($is_subadmin){
            $groups = DB::table('groups')
                                ->join('subadmins','subadmins.group_id','groups.id')
                                ->where('subadmin_id','=',Auth::user()->id)
                                ->get();
        }
        else if(Auth::check() && Auth::user()->is_admin == true)
        {
            $groups = DB::table('groups')->get();
        }
        else
        {
            $groups = null;
        }
           
        return View::make('miestnost')
        ->with('roomName',$magicRoom)
        ->with('rooms',$result)
        ->with('roomlist', $items)
        ->with('collect',$collection)
        ->with('times',$collectionTimes)
        ->with('is_subadmin',$is_subadmin)
        ->with('groups',$groups);

    }

    public function filterGroup(Request $request){

    	if(Input::get("group")=="vyber")
            return back()->withErrors(['Status' => 'Nezadali ste žiadnu skupinu.']);

        $collection = $this->days();
        $magicGroup = $request->input('group');
        if(session('groupname'))
            $magicGroup = session('groupname');
        $items = \App\Group::pluck('name');
		
		$result = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('groups', 'groups.id', '=', 'meetings.group_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->select('meetings.id as id', 'meetings.repeat as repeat','rooms.name as room', 'dates.time as time', 'groups.name as group', DB::raw("time(strftime('%s', dates.time) + dates.duration * 60,  'unixepoch') as end_time"), 'dates.day as day')
                    ->where('meetings.is_approved', '=', true)
                    ->where('groups.name', '=', $magicGroup)
                    ->where('meetings.blacklisted', '=', false)
                    ->get();

        if(Auth::check()){
        $is_subadmin = DB::table('groups')
                    ->join('subadmins', 'subadmins.group_id', '=','groups.id')
                    ->whereColumn([
                        ['groups.name', '=', $magicGroup],
                        ['subadmins.subadmin_id', '=', Auth::user()->id]
                    ])->count();
        }
        else
            $is_subadmin = 0;
                          
        return View::make('skupina')->with('groups',$result)->with('grouplist', $items)->with('collect',$collection)->with('groupName',$magicGroup)->with('is_subadmin',$is_subadmin);
        
    }

    public function getRooms(){
        $items = \App\Room::where('is_available',true)->select('rooms.name as name')->get();
        $i = DB::table('meetings')
                    ->join('rooms', 'rooms.id', '=', 'meetings.room_id')
                    ->select('rooms.name as name')
                    ->where('meetings.is_approved', '=', true)
                    ->where('rooms.is_available', '=', false)
                    ->where('rooms.name', '!=', 'WC')
                    ->where('rooms.name', '!=', 'wc')
                    ->where('meetings.blacklisted', '=', false)
                    ->get();
        if($i->count()>0){
           $items = $items->concat($i);
        }
        return $items;
    }

    public function loadrooms(){
        $items = $this->getRooms();
        return View::make('miestnost')->with('roomlist', $items);
    }

    public function loadgroups(){
        $items = \App\Group::pluck('name');
        return View::make('skupina')->with('grouplist', $items);
    }
}
