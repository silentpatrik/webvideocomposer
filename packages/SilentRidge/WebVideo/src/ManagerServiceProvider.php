<?php

namespace WebVideo;

use Illuminate\Support\Facades\File;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use WebVideo\Commands\Dev;
use WebVideo\Commands\Help;
use WebVideo\Commands\Install;
use WebVideo\Commands\ManagerCommand;
use WebVideo\Commands\ProcessCommand;
use WebVideo\Commands\Render;

class ManagerServiceProvider extends PackageServiceProvider
{
    #protected Package $package;
    protected $commands = [
        ManagerCommand::class,
        Help::class,
        Install::class,
        Render::class,
        ProcessCommand::class,

    ];
    protected $devCommands = [
        Dev::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('web-video-manager')
            ->hasConfigFile()
            ->hasMigration('create_package_tables')
            ->hasCommands($this->commands)
            ->hasCommands($this->devCommands)
            ->hasMigrations(File::allFiles(__DIR__ . '/Database/Migrations'));
    }

    /*
        public function configurePackage(Package $package): void
        {
            $package
                ->hasConfigFile()
                //->hasConfigFile()
                //->hasViews()
                //->hasViewComponent('spatie', Alert::class)
                //->hasViewComposer('*', MyViewComposer::class)
                //->sharesDataWithAllViews('downloads', 3)
                //->hasTranslations()
                //->hasAssets()
                //->hasRoute('web')
                ->hasMigration('create_package_tables')
                ->hasCommands($this->commands)
                ->hasCommands($this->devCommands)
                ->hasMigrations(File::allFiles(__DIR__ . "/../Database/Migrations"));
        }*/
}
