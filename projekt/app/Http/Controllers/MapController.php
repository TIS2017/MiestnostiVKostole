<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;


class MapController extends Controller {

	public static function getRooms() {
		return DB::table('rooms')->select('rooms.name', 'rooms.abbreviation')->get();
	}
	

	public static function getMeetings() {		
		$GLOBALS['timezone'] = 'Europe/Bratislava';
		$GLOBALS['current_time'] = Carbon::now($GLOBALS['timezone']);

		$end_time = DB::raw("time(strftime('%s', dates.time) + dates.duration * 60,  'unixepoch') as end_time");

		$all_meetings = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('dates', 'dates.id', '=', 'meetings.date_id')
					->where('dates.day', '=', $GLOBALS['current_time']->dayOfWeek)
					->select('rooms.name', 'dates.time', $end_time)
					->get();	

		$all_meetings = json_decode(json_encode($all_meetings), true);
		
		$meetings = array_where($all_meetings, function($value, $key) {			
			$meeting_hour 	= 	explode(':', $value['time'])[0];
			$meeting_minute = 	explode(':', $value['time'])[1];
			
			$first = Carbon::createFromTime($meeting_hour, $meeting_minute, null, $GLOBALS['timezone']);
			$second = (clone $first)->addHour();
			
			return $GLOBALS['current_time']->between($first, $second);
		});

		return $meetings;
	}
	
	public function click(Request $request, $room) {
		$fc = new FilterController();

		$magicRoom = $room;
        $items = \App\Room::where('is_available',true)->get();
        $collection = $fc->days();
        $collectionTimes = $fc->times(); 
		
		$end_time = DB::raw("time(strftime('%s', dates.time) + dates.duration * 60,  'unixepoch') as end_time");
		
		$result = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('groups', 'groups.id', '=', 'meetings.group_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->select('dates.time as time', 'groups.name as group', $end_time, 'dates.day as day')
                    ->where('meetings.is_approved', '=', true)
                    ->where('rooms.name', '=', $magicRoom)
                    ->where('meetings.blacklisted', '=', false)
                    ->get();

		
        $is_subadmin = $fc->is_subadmin();
        
        if($is_subadmin){
            $subadmin_groups = DB::table('groups')
                                ->join('subadmins','subadmins.group_id','groups.id')
                                ->where('subadmin_id','=',Auth::user()->id)
                                ->get();
        }
        else if(Auth::check() && Auth::user()->is_admin == true)
        {
            $subadmin_groups = DB::table('groups')->get();
        }
        else
            $subadmin_groups = null;

           
        return View::make('miestnost')
				->with('roomName',$magicRoom)
				->with('rooms',$result)
				->with('roomlist', $items)
				->with('collect',$collection)
				->with('times',$collectionTimes)
				->with('is_subadmin',$is_subadmin)
				->with('groups',$subadmin_groups);
    }

}