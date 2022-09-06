<?php

namespace App\Console;

use App\Http\Services\ServerOnline;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command("server:updateOnline")->everyFifteenMinutes()->description("Servers online updater");
        $schedule->command("server:updateRating")->everyFifteenMinutes()->description("Servers rating updater");
        $schedule->command("server:updateVotes")->everyFifteenMinutes()->description("Servers vote updater");
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
