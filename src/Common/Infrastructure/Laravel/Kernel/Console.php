<?php

namespace Src\Common\Infrastructure\Laravel\Kernel;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Src\Common\Presentation\CLI\CreateControllerCmd;
use Src\Common\Presentation\CLI\CreateDomainCmd;
use Src\Common\Presentation\CLI\CreateRoutesCmd;

class Console extends ConsoleKernel
{
    /**
     * The Artisan commands provided by the application.
     *
     * @var array
     */
    protected $commands = [
        CreateDomainCmd::class,
        CreateControllerCmd::class,
        CreateRoutesCmd::class
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        require base_path('routes/console.php');
    }
}
