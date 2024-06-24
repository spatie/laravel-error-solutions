<?php

use Spatie\LaravelErrorSolutions\Actions\GetSolutionsForLatestThrowableAction;
use Spatie\LaravelErrorSolutions\SpatieRenderer;
use Spatie\ErrorSolutions\Solutions\Laravel\RunMigrationsSolution;

it('can get the solutions for the latest throwable', function () {
    SpatieRenderer::$latestThrowable = $this->getThrowable();

    $solutions = app(GetSolutionsForLatestThrowableAction::class)->execute();

    expect($solutions)->toHaveCount(1);

    $solution = $solutions[0];

    expect($solution)->toBeInstanceOf(RunMigrationsSolution::class);
});

it('will not crash when no throwable is set', function () {
    $solutions = app(GetSolutionsForLatestThrowableAction::class)->execute();

    expect($solutions)->toHaveCount(0);
});

