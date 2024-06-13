<?php

namespace Spatie\LaravelErrorSolutions\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Spatie\ErrorSolutions\Contracts\SolutionProviderRepository;
use Spatie\LaravelErrorSolutions\Exceptions\CannotExecuteSolutionForNonLocalIp;
use Spatie\LaravelErrorSolutions\Http\Requests\ExecuteSolutionRequest;
use Spatie\LaravelErrorSolutions\RunnableSolutionsGuard;

class ExecuteSolutionController
{
    use ValidatesRequests;

    public function __invoke(
        ExecuteSolutionRequest $request,
        SolutionProviderRepository $solutionProviderRepository
    ) {
        $this
            ->ensureRunnableSolutionsEnabled()
            ->ensureLocalRequest();

        $solution = $request->getRunnableSolution();

        $solution->run($request->get('parameters', []));

        return response()->noContent();
    }

    public function ensureRunnableSolutionsEnabled(): self
    {
        abort_unless(RunnableSolutionsGuard::check(), 400);

        return $this;
    }

    public function ensureLocalRequest(): self
    {
        $ipIsPublic = filter_var(
            request()->ip(),
            FILTER_VALIDATE_IP,
            FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );

        if ($ipIsPublic) {
            throw CannotExecuteSolutionForNonLocalIp::make();
        }

        return $this;
    }
}
