<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
$current = new Carbon();

class DeleteDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete single meetings everz day at 22:00';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $current = new Carbon();


        $idd = DB::table('meetings')
        ->join('dates','dates.id','meetings.date_id')
        ->where('meetings.repeat','=',1)
        ->where('dates.day','=',$current->dayOfWeek)
        ->select('meetings.id as mid','dates.id as did')
        ->get();


        if(!empty($idd)){
            foreach($idd as $items){
                DB::table('meetings')->where('id', '=', $items->mid)->delete();
                DB::table('dates')->where('id', '=', $items->did)->delete();
            }
            $this->info("Meetings and dates are deleted sucessfully");
        }



        $this->info($idd);
    }
}
