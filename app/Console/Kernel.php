<?php

namespace App\Console;

use App\Console\Commands\MyCustomCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('My:myCustomCommand')
            ->everyMinute()
            ->pingBefore('youtube.com')
            ->thenPing('google.com')
            ->onFailure(function () {
            Log::error('The task failed after pings.');
            })
            ->before(function () {
            Log::info('Ping before youtube.com');
            })
            ->after(function () {
            Log::info('Ping after google.com');
            });
    }


    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }


    protected $commands = [
        Commands\MyCustomCommand::class,
    ];
}
