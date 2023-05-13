<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;
class StartApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts the application with migrations and seeders ';

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
     * @return int
     */
    public function handle()
    {
        $this->info('Starting the application...');

        Artisan::call('migrate');
        $this->info('Migrations executed successfully.');

        if (DB::table('users')->count() === 0) {
            Artisan::call('db:seed');
            $this->info('Seeders executed successfully.');
        }

        Artisan::call('serve', ['--port' => 8000], $this->getOutput());
        $this->info('The application is running on: ' . env('APP_URL'));
    }
}
