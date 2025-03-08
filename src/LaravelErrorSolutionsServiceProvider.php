<?php

namespace Spatie\LaravelErrorSolutions;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Exceptions\Renderer\Listener;
use Illuminate\Foundation\Exceptions\Renderer\Mappers\BladeMapper;
use Illuminate\Foundation\Exceptions\Renderer\Renderer;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Spatie\ErrorSolutions\Contracts\SolutionProviderRepository as SolutionProviderRepositoryContract;
use Spatie\ErrorSolutions\DiscoverSolutionProviders;
use Spatie\ErrorSolutions\SolutionProviderRepository;
use Spatie\LaravelErrorSolutions\Http\Controllers\ExecuteSolutionController;
use Spatie\LaravelErrorSolutions\Support\RunnableSolutionsGuard;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;

class LaravelErrorSolutionsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('error-solutions')
            ->hasConfigFile();

        if ($this->canIncludeViews()) {
            $package->hasViews();
        }
    }

    public function bootingPackage()
    {
        if ($this->app['config']->get('error-solutions.enable_runnable_solutions')) {
            Route::post('__execute-laravel-error-solution', ExecuteSolutionController::class)->name('execute-laravel-error-solution');
        }

        app()->scoped(SolutionProviderRepositoryContract::class, function () {
            [$configuredSolutionProviders, $labels] = collect(config('error-solutions.solution_providers'))->partition(function (string $labelOrClassName) {
                return class_exists($labelOrClassName);
            });

            $discoveredSolutionProviders = DiscoverSolutionProviders::for($labels->toArray());

            $solutionProviders = array_merge($discoveredSolutionProviders, $configuredSolutionProviders->toArray());

            return new SolutionProviderRepository($solutionProviders);
        });

        app()->bind(RunnableSolutionsGuard::class, fn () => new RunnableSolutionsGuard);

        app()->bind(Renderer::class, function () {
            $errorRenderer = new HtmlErrorRenderer(
                $this->app['config']->get('app.debug'),
            );

            return new SpatieRenderer(
                $this->app->make(Factory::class),
                $this->app->make(Listener::class),
                $errorRenderer,
                $this->app->make(BladeMapper::class),
                $this->app->basePath(),
            );
        });

        if ($this->canIncludeViews()) {
            View::prependNamespace('laravel-exceptions-renderer',
                [
                    __DIR__.'/../resources/views',
                ]);
        }
    }

    protected function canIncludeViews(): bool
    {
        return config('app.debug') === true;
    }
}
