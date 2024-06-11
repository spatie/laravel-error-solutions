<?php

namespace Spatie\LaravelErrorSolutions;

use Spatie\LaravelErrorSolutions\Commands\LaravelErrorSolutionsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelErrorSolutionsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-error-solutions')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-error-solutions_table')
            ->hasCommand(LaravelErrorSolutionsCommand::class);
    }
}
