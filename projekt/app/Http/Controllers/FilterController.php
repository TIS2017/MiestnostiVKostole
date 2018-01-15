<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use App\Room;
use App\Group;
use DateTime;



class FilterController extends Controller
{
    
    public function filterTime(Request $request){

        $collection = collect([
            '1' => 'Pondelok',
            '2' => 'Utorok',
            '3' => 'Streda',
            '4' => 'Štvrtok',
            '5' => 'Piatok',
            '6' => 'Sobota',
            '7' => 'Nedeľa',
        ]);

        $from = $request->input('od');
        $to = $request->input('do');
        $magicday = $request->input('den');

        

		$result = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('groups', 'groups.id', '=', 'meetings.group_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->select('rooms.name as room', 'dates.time as time', 'groups.name as group')
                    //->where('dates.time', '>', strval($from) . ':00')
                    //->where('dates.time', '<', strval($to) . ':00')
                    ->where('dates.day', '=', $magicday)
                    ->get();


        $dotext = $to . ":00";
        $fromtext = $from . ":00";
        $chosenday = $collection->get($magicday);
        
        return View::make('cas')->with('times',$result)->with('to',$dotext)->with('from',$fromtext)->with('day',$chosenday);


    }

    public function filterRoom(Request $request){

        $magicRoom = $request->input('room');
        $items = \App\Room::pluck('name');
        $collection = collect([
            '1' => 'Pondelok',
            '2' => 'Utorok',
            '3' => 'Streda',
            '4' => 'Štvrtok',
            '5' => 'Piatok',
            '6' => 'Sobota',
            '7' => 'Nedeľa',
        ]);
		
		$result = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('groups', 'groups.id', '=', 'meetings.group_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->select('rooms.name as room', 'dates.time as time', 'groups.name as group', DB::raw("time(strftime('%s', dates.time) + dates.duration * 60,  'unixepoch') as end_time"), 'dates.day as day')
                    ->where('rooms.name', '=', $magicRoom)
					->get();

                
        return View::make('miestnost')->with('rooms',$result)->with('roomlist', $items)->with('collect',$collection);

    }

    public function filterGroup(Request $request){

        $collection = collect([
            '1' => 'Pondelok',
            '2' => 'Utorok',
            '3' => 'Streda',
            '4' => 'Štvrtok',
            '5' => 'Piatok',
            '6' => 'Sobota',
            '7' => 'Nedeľa',
        ]);
        $magicGroup = $request->input('group');
        $items = \App\Group::pluck('name');
		
		$result = DB::table('meetings')
					->join('rooms', 'rooms.id', '=', 'meetings.room_id')
					->join('groups', 'groups.id', '=', 'meetings.group_id')
                    ->join('dates', 'dates.id', '=', 'meetings.date_id')
                    ->select('rooms.name as room', 'dates.time as time', 'groups.name as group', DB::raw("time(strftime('%s', dates.time) + dates.duration * 60,  'unixepoch') as end_time"), 'dates.day as day')
                    ->where('groups.name', '=', $magicGroup)
                    ->get();
                    
                   
        
                
        return View::make('skupina')->with('groups',$result)->with('grouplist', $items)->with('collect',$collection);
        
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
