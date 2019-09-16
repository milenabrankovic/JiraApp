<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\Sprint;
use App\Models\Sprint_Info;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {   
        $schedule->call(function () {
            
            $sprint_info = Sprint_Info::where('active', 1)->first();
            $sprint_length = $sprint_info->length;
            $active_sprints = Sprint::where('active', 1)->get();
            $current_date = Carbon::now()->startOfDay();

            foreach($active_sprints as $sprint){

                $sprint_date = Carbon::parse($sprint->start_date);

                if(Carbon::now() >= $sprint_date->addDays($sprint_length)){

                    Sprint::where(['project_id'=> $sprint->project_id, 'active'=> 1])->update(['active'=>0]);
                    $new_sprint = new Sprint;
                    $new_sprint->start_date = $current_date->format('Y-m-d H:i:s');
                    $new_sprint->sprint_info_id = $sprint_info->sprint_info_id;
                    $new_sprint->project_id = $sprint->project_id;
                    $new_sprint->active = 1;
                    $new_sprint->save();
                }
            }

        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
