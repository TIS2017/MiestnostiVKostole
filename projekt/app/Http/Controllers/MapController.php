<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Room;
use App\Group;


class MapController extends Controller 
{

	public static function getMeetings() {
	
	
		$meetings = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('dates', 'dates.id', '=', 'meetings.date_id')
					->select('rooms.abbreviation', 'dates.year', 'dates.month', 'dates.day', 'dates.time', 'dates.duration')
					->get();
					
		$rooms = DB::table('rooms')->select('rooms.name', 'rooms.abbreviation')->get();
		


		return collect([$meetings, $rooms]);

	}

}