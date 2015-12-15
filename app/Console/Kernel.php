<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;

use Laravel\Lumen\Console\Kernel as ConsoleKernel;
use Symfony\Component\Finder\Finder;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\SlackStatusCommand',
        'App\Console\Commands\SlackTeamInfoCommand',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        // Schedule to check the users status
        $schedule->command('slack:status')->everyMinute()->withoutOverlapping();

        // Remove previous cache of "withoutOverlapping"
        $schedule->call(function () {
            $files = Finder::create()->files()
                ->in(storage_path('framework'))
                ->depth(0)
                ->date('< today')
                ->name('schedule-*');

            foreach ($files as $file) {
                @unlink($file->getRealPath());
            }
        })->daily();
    }
}
