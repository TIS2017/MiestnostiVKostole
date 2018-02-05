<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MeetingVisibility extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:meetings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the meeting blacklist boolean to false at Sunday evening, to be visible on next week. Used by FilterController@deleteOnce';

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
        DB::table('meetings')->where('blacklisted', 1)->update(['blacklisted' => false]);
    }
}
