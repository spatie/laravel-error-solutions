<?php

namespace Spatie\LaravelErrorSolutions;

class RunnableSolutionsGuard
{
    /**
     * Check if runnable solutions are allowed based on the current
     * environment and config.
     */
    public static function check(): bool
    {
        if (! config('app.debug')) {
            // Never run solutions in when debug mode is not enabled.

            return false;
        }

        if (config('error-solutions.enable_runnable_solutions')) {
            return true;
        }

        if (! app()->environment('local') && ! app()->environment('development')) {
            // Never run solutions on non-local environments. This avoids exposing
            // applications that are somehow APP_ENV=production with APP_DEBUG=true.

            return false;
        }

        return config('app.debug');
    }
}
