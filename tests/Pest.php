<?php

use Composer\InstalledVersions;
use Spatie\LaravelErrorSolutions\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function orchestraVersionEqualOrHigherThen(int $versionNumber)
{
    return version_compare(InstalledVersions::getVersion('orchestra/testbench'), '10.0.0', '>=');
}
