<?php

namespace WebVideo\Commands;

use Symfony\Component\Console\Input\InputArgument;

class Dev extends ManagerCommand
{
    protected $signature = 'manager:dev';

    protected $description = 'Development helper for video manager';

    public function handle()
    {
        $this->addArgument('help', InputArgument::OPTIONAL, 'Ge thelp');
        $this->addArgument('test', InputArgument::OPTIONAL, 'run tests');
        $this->addArgument('status', InputArgument::OPTIONAL, 'see statuses of all things');
    }
}
