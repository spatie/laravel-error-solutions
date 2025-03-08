<?php

use Composer\InstalledVersions;
use Spatie\LaravelErrorSolutions\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

ensureEnvFileExists();

function ensureEnvFileExists()
{
    $envPath = version_compare(InstalledVersions::getVersion('orchestra/testbench'), '10.0.0', '>=')
        ? '.env'
        : 'vendor/orchestra/testbench-core/laravel/.env';

    @touch($envPath);
}
