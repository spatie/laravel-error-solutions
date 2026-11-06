<?php

namespace Spatie\LaravelErrorSolutions\Actions;

use Spatie\ErrorSolutions\Contracts\RunnableSolution;
use Spatie\ErrorSolutions\Contracts\Solution;
use Spatie\ErrorSolutions\Contracts\SolutionProviderRepository;
use Spatie\LaravelErrorSolutions\SpatieRenderer;
use Throwable;

class GetSolutionsForLatestThrowableAction
{
    public function __construct(
        protected SolutionProviderRepository $solutionProviderRepository
    ) {}

    /**
     * @return array<Solution|RunnableSolution>
     */
    public function execute(): array
    {
        $throwable = SpatieRenderer::$latestThrowable;

        if (! $throwable) {
            return [];
        }

        $solutions = [];

        try {
            $solutions = $this->solutionProviderRepository->getSolutionsForThrowable($throwable);
        } catch (Throwable $exception) {

        }

        return $solutions;
    }
}
