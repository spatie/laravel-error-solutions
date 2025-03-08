<?php

use Spatie\ErrorSolutions\Solutions\Laravel\GenerateAppKeySolution;

beforeEach(function () {
    // needed in <L12
    @touch(base_path('/vendor/orchestra/testbench-core/laravel/.env'));

    config()->set('app.debug', true);
});

it('can execute a solution', function () {
    $this
        ->post(route('execute-laravel-error-solution'), [
            'solution' => GenerateAppKeySolution::class,
        ])
        ->assertSuccessful();
});

it('will not execute a solution when app debug is set to false', function () {
    config()->set('app.debug', false);

    $this
        ->post(route('execute-laravel-error-solution'), [
            'solution' => GenerateAppKeySolution::class,
        ])
        ->assertBadRequest();
});

it('will not execute a solution when runnable solutions is set to false', function () {
    config()->set('error-solutions.enable_runnable_solutions', false);

    $this
        ->post(route('execute-laravel-error-solution'), [
            'solution' => GenerateAppKeySolution::class,
        ])
        ->assertBadRequest();
});
