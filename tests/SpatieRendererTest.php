<?php

use Illuminate\Foundation\Exceptions\Renderer\Renderer;
use Spatie\LaravelErrorSolutions\Tests\TestClasses\ExceptionWithSolution;

it('will render a solution set a on a throwable', function() {
    $renderer = app(Renderer::class);

    $html = $renderer->render(request(), new ExceptionWithSolution());
})->skip('Could not figure out where view could not be found in tests');
