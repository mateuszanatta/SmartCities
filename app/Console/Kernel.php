<?php

namespace SmartCity\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //\SmartCity\Console\Commands\Inspire::class,
        // \SmartCity\Console\Commands\FacebookUserTags::class,//regiter the command on artisan

    ];


    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        //It will excute the class SocialWorkerController at midnight and retrieve the user tags from facebook
       $schedule->call("SmartCity\Http\Controllers\SocialWorkerController@index")
                ->daily();
                // ->name("facebooktags")
                // ->withoutOverlapping();

      //It will excute the class FacebookPagesController every saturday and cities' Facebook pages posts
      $schedule->call("SmartCity\Http\Controllers\FacebookPagesController@index")
               ->saturdays();

    }
}
