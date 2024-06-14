<?php

namespace Spatie\LaravelErrorSolutions\Support;

class RunnableSolutionsGuard
{
    public static function check(): bool
    {
        if (! config('app.debug')) {
            return false;
        }

        if (! config('error-solutions.enable_runnable_solutions')) {
            return false;
        }

        if (! self::isLocalRequest()) {
            return false;
        }

        return true;
    }

    protected static function isLocalRequest(): bool
    {
        if (! app()->environment('local') && ! app()->environment('development')) {
            return false;
        }

        $ipIsPublic = filter_var(
            request()->ip(),
            FILTER_VALIDATE_IP,
            FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );

        if ($ipIsPublic) {
            return false;
        }

        return true;
    }
}
