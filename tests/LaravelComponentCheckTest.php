<?php

use function Spatie\Snapshots\assertMatchesFileSnapshot;

it('still is the same laravel navigation blade component', function () {
    assertMatchesFileSnapshot(__DIR__.'/../vendor/laravel/framework/src/Illuminate/Foundation/resources/exceptions/renderer/components/header.blade.php');
})->skipOnWindows();
