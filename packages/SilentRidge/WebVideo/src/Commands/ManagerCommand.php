<?php

namespace WebVideo\Commands;

use Deerdama\ConsoleZoo\ConsoleZoo;
use Illuminate\Console\Command;
use Illuminate\Support\Env;
use Symfony\Component\Console\Input\InputOption;

class ManagerCommand extends Command
{
    use ConsoleZoo;

    protected $signature = 'manager';
    protected $name = 'Web Video Composer Manager';
    protected $description = 'Main app command used for everything in video worker project';


    public function __construct()
    {
        parent::__construct();
        #foreach ($this->commands as $command => $class) {

        #$this->addArgument($command, InputArgument::OPTIONAL, 'Help mode', 'manager:help');
        # }
        #$this->zooSetDefaults(['timestamp' => 'true', 'icons' => 'COOKED_RICE']);
    }

    public
    function handle()
    {

        match ($this->options()) {

            'install' => $this->call('manager:install'),
            'run' => $this->call('manager:video'),
            default => $this->call('manager:help'),
        };
    }

    protected function getOptions()
    {
        return [
            ['host', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on', '127.0.0.1'],
            ['port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on', Env::get('SERVER_PORT')],
            ['tries', null, InputOption::VALUE_OPTIONAL, 'The max number of ports to attempt to serve from', 10],
            ['no-reload', null, InputOption::VALUE_NONE, 'Do not reload the development server on .env file changes'],
        ];
    }
}
