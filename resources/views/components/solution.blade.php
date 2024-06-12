@php

    $solutions = app(\Spatie\LaravelErrorSolutions\Actions\GetSolutionsForLatestThrowableAction::class)->execute($exception);

@endphp

This is the solution component.
