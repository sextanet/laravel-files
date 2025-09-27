<?php

namespace SextaNet\LaravelFiles;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use SextaNet\LaravelFiles\Commands\LaravelFilesCommand;

class LaravelFilesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-files')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_files_table')
            ->hasCommand(LaravelFilesCommand::class);
    }
}
