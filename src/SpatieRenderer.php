<?php

namespace Spatie\LaravelErrorSolutions;

use Illuminate\Foundation\Exceptions\Renderer\Exception;
use Illuminate\Foundation\Exceptions\Renderer\Renderer;
use Illuminate\Http\Request;
use Throwable;

class SpatieRenderer extends Renderer
{
    public static ?Throwable $latestThrowable = null;

    public function render(Request $request, Throwable $throwable)
    {
        $flattenException = $this->bladeMapper->map(
            $this->htmlErrorRenderer->render($throwable),
        );

        $exception = new Exception($flattenException, $request, $this->listener, $this->basePath);

        $exceptionAsMarkdown = $this->viewFactory->make('laravel-exceptions-renderer::markdown', [
            'exception' => $exception,
        ])->render();

        self::$latestThrowable = $throwable;

        return $this->viewFactory->make('laravel-exceptions-renderer::show', [
            'exception' => $exception,
            'exceptionAsMarkdown' => $exceptionAsMarkdown,
        ])->render();
    }
}
