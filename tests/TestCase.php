<?php

namespace Spatie\LaravelErrorSolutions\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelErrorSolutions\LaravelErrorSolutionsServiceProvider;
use Throwable;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Spatie\\LaravelErrorSolutions\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelErrorSolutionsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'mysql');
    }

    function getThrowable(): Throwable
    {
        try {
            User::all();
        } catch (Throwable $throwable) {
            return $throwable;
        }
    }
}
