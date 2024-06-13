<?php

namespace Spatie\LaravelErrorSolutions\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Spatie\ErrorSolutions\Contracts\SolutionProviderRepository;
use Spatie\LaravelErrorSolutions\Exceptions\CannotExecuteSolutionForNonLocalIp;
use Spatie\LaravelErrorSolutions\Http\Requests\ExecuteSolutionRequest;
use Spatie\LaravelErrorSolutions\Support\RunnableSolutionsGuard;

class ExecuteSolutionController
{
    use ValidatesRequests;

    public function __invoke(
        ExecuteSolutionRequest $request,
        SolutionProviderRepository $solutionProviderRepository
    ) {
        abort_unless(RunnableSolutionsGuard::check(), 400);

        $solution = $request->getRunnableSolution();

        $solution->run($request->get('parameters', []));

        return response()->noContent();
    }
}
