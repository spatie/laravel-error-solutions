<?php

namespace Spatie\LaravelErrorSolutions;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Exceptions\Renderer\Listener;
use Illuminate\Foundation\Exceptions\Renderer\Mappers\BladeMapper;
use Illuminate\Foundation\Exceptions\Renderer\Renderer;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\View;
use Spatie\LaravelErrorSolutions\Http\Controllers\ExecuteSolutionController;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;

class LaravelErrorSolutionsServiceProvider extends PackageServiceProvider
{
    public function registeringPackage()
    {
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

        if ($this->app['config']->get('error-solutions.enable_runnable_solutions')) {
            Route::get('__execute-laravel-error-solution', ExecuteSolutionController::class)->name('execute-laravel-error-solution');

        }
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-error-solutions')
            ->hasConfigFile()
            ->hasViews();
    }
}
