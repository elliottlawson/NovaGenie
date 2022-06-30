<?php

namespace ElliottLawson\NovaGenie;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ElliottLawson\NovaGenie\Commands\NovaGenieCommand;

class NovaGenieServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('novagenie')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_novagenie_table')
            ->hasCommand(NovaGenieCommand::class);
    }
}
