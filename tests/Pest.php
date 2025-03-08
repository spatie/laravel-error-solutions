<?php

use Spatie\LaravelErrorSolutions\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

ensureEnvFileExists();

function ensureEnvFileExists()
{
    @touch('.env');
    @touch('vendor/orchestra/testbench-core/laravel/.env');
}
