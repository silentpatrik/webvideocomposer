<?php

namespace WebVideo\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use function App\Console\Commands\WebVideo\resolveCommand;
use function collect;
use function dd;
use function env;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manager:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cretes database and installs';

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

        $cmdline = collect('mysql -u' . env('DB_USERNAME'))
            ->join(env('DB_password') && env('DB_PASSWORD') != '' ? '-p' . env('DB_PASSWORD') : '')
            ->join(" -e 'create database '" . env('DB_DATABASE'));
        dd($cmdline);
        $command = Process::fromShellCommandline($cmdline);

        $this->call(resolveCommand($command));
        return 0;
    }
}
