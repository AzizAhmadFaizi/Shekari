<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\License;
use App\Models\Organization;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            $today = Carbon::today()->format('Y-m-d');

            Organization::whereHas('licenses', function ($q) use ($today) {
                $q->where('expire_date', '<', $today);
            })
            ->where('status', 1)
            ->update(['status' => 0]);

             // Log the info
        // \Log::info("Organization status update ran at " . now() . ". Total updated: {$updatedCount}");

        // })->daily();
        })->everyMinute();

    //================ command for schedule work ==============
    // php artisan schedule:work
    //================ command for run once manually no waiting for scheduel time (it's work to set the ->everyMinute() method ) ==============
    // php artisan schedule:run

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
