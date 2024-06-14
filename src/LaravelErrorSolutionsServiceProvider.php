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
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;

class LaravelErrorSolutionsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('error-solutions')
            ->hasConfigFile()
            ->hasViews();
    }

    public function bootingPackage()
    {
        if ($this->app['config']->get('error-solutions.enable_runnable_solutions')) {
            Route::post('__execute-laravel-error-solution', ExecuteSolutionController::class)->name('execute-laravel-error-solution');
        }

        app()->bind(SolutionProviderRepositoryContract::class, function () {
            $solutionProviders = DiscoverSolutionProviders::for(['php', 'laravel']);

            return new SolutionProviderRepository($solutionProviders);
        });

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

        View::prependNamespace('laravel-exceptions-renderer', [__DIR__.'/../resources/views']);
    }
}
