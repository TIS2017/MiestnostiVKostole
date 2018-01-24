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

        $collection = $this->days();

        $from = $request->input('od');
        $to = $request->input('do');
        $magicday = $request->input('den');
        if($magicday=="vyber")
            $magicday = 1; //default pondelok

		$result = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('groups', 'groups.id', '=', 'meetings.group_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->select('rooms.name as room', 'dates.time as time', 'groups.name as group')
                    ->where('dates.day', '=', $magicday)
                    ->where('dates.time', '>=', $from)
                    ->where('dates.time', '<', $to)
                    ->get();


        $chosenday = $collection->get($magicday);
        return View::make('cas')->with('times',$result)->with('to',$to)->with('from',$from)->with('day',$chosenday);


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
    	for($i = 8; $i< 21;$i++){
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
						->where('groups.subadmin_id', '=', Auth::user()->id)
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
        $items = \App\Room::pluck('name');
        $collection = $this->days();
        $collectionTimes = $this->times(); 
		
		$result = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('groups', 'groups.id', '=', 'meetings.group_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->select('dates.time as time', 'groups.name as group', DB::raw("time(strftime('%s', dates.time) + dates.duration * 60,  'unixepoch') as end_time"), 'dates.day as day')
                    ->where('rooms.name', '=', $magicRoom)
					->get();

		
	    $is_subadmin = $this->is_subadmin();
           
        return View::make('miestnost')->with('roomName',$magicRoom)->with('rooms',$result)->with('roomlist', $items)->with('collect',$collection)->with('times',$collectionTimes)->with('is_subadmin',$is_subadmin);

    }

    public function filterGroup(Request $request){

    	if(Input::get("group")=="vyber")
            return back()->withErrors(['Status' => 'Nezadali ste žiadnu skupinu.']);

        $collection = $this->days();
        $magicGroup = $request->input('group');
        $items = \App\Group::pluck('name');
		
		$result = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('groups', 'groups.id', '=', 'meetings.group_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->select('rooms.name as room', 'dates.time as time', 'groups.name as group', DB::raw("time(strftime('%s', dates.time) + dates.duration * 60,  'unixepoch') as end_time"), 'dates.day as day')
                    ->where('groups.name', '=', $magicGroup)
                    ->get();

        if(Auth::check()){
        $is_subadmin = DB::table('groups')
                    ->whereColumn([
                        ['groups.name', '=', $magicGroup],
                        ['groups.subadmin_id', '=', Auth::user()->id]
                    ])->count();
        }
        else
            $is_subadmin = 0;
                          
        return View::make('skupina')->with('groups',$result)->with('grouplist', $items)->with('collect',$collection)->with('groupName',$magicGroup)->with('is_subadmin',$is_subadmin);
        
    }

    public function loadrooms(){
        $items = \App\Room::pluck('name');
        return View::make('miestnost')->with('roomlist', $items);
    }

    public function loadgroups(){
        $items = \App\Group::pluck('name');
        return View::make('skupina')->with('grouplist', $items);
    }
}
