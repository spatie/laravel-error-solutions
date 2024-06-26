<?php

use Spatie\ErrorSolutions\Solutions\Laravel\RunMigrationsSolution;
use Spatie\LaravelErrorSolutions\Actions\GetSolutionsForLatestThrowableAction;
use Spatie\LaravelErrorSolutions\SpatieRenderer;

beforeEach(function () {
    SpatieRenderer::$latestThrowable = null;
});

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

it('will not crash when an unknown throwable is set', function () {
    SpatieRenderer::$latestThrowable = (new Exception('unknown throwable'));

    $solutions = app(GetSolutionsForLatestThrowableAction::class)->execute();

    expect($solutions)->toHaveCount(0);
});
