<?php

namespace WebVideo\Commands;

class Help extends ManagerCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manager:help';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Contains help';

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
        $this->surprise('lla');
        return 0;
    }
}
