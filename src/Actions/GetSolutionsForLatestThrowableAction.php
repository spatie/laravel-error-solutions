<?php

namespace Spatie\LaravelErrorSolutions\Actions;

use Spatie\ErrorSolutions\DiscoverSolutionProviders;
use Spatie\ErrorSolutions\SolutionProviderRepository;
use Spatie\LaravelErrorSolutions\SpatieRenderer;

class GetSolutionsForLatestThrowableAction
{
    /**
     * @return array<\Spatie\ErrorSolutions\Contracts\Solution|\Spatie\ErrorSolutions\Contracts\RunnableSolution>
     */
    public function execute(): array
    {
        $solutionProviders = DiscoverSolutionProviders::for(['php', 'laravel']);

        $providerRepository = new SolutionProviderRepository($solutionProviders);

        $throwable = SpatieRenderer::$latestThrowable;

        return $providerRepository->getSolutionsForThrowable($throwable);
    }
}
