<?php

use Spatie\ErrorSolutions\Solutions\Laravel\GenerateAppKeySolution;

beforeEach(function() {
   touch(base_path('/vendor/orchestra/testbench-core/laravel/.env'));
});

it('can execute a solution', function () {
    config()->set('app.debug', true);

    $this
        ->post(route('execute-laravel-error-solution'), [
            'solution' => GenerateAppKeySolution::class,
        ])
        ->assertSuccessful();
});

it('will not execute a solution when app debug is set to false', function(){
    config()->set('app.debug', false);

    $this
        ->post(route('execute-laravel-error-solution'), [
            'solution' => GenerateAppKeySolution::class,
        ])
        ->assertBadRequest();

});
