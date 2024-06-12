<?php

namespace Spatie\LaravelErrorSolutions\Actions;

use Spatie\ErrorSolutions\DiscoverSolutionProviders;
use Spatie\ErrorSolutions\SolutionProviderRepository;
use Spatie\LaravelErrorSolutions\SpatieRenderer;

class GetSolutionsForLatestThrowableAction
{
    public function execute(): array
    {
        $solutionProviders = DiscoverSolutionProviders::for(['php', 'laravel']);

        $providerRepository = new SolutionProviderRepository($solutionProviders);

        $throwable = SpatieRenderer::$latestThrowable;

        $solutions = $providerRepository->getSolutionsForThrowable($throwable);

        dd($solutions);
    }
}
