<?php

namespace Spatie\LaravelErrorSolutions\Support;

use Spatie\LaravelErrorSolutions\Exceptions\CannotExecuteSolutionForNonLocalIp;

class RunnableSolutionsGuard
{
    public static function check(): bool
    {
        if (! config('app.debug')) {
            return false;
        }

        if (config('error-solutions.enable_runnable_solutions')) {
            return true;
        }

        return config('app.debug');
    }

    public function ensureLocalRequest(): self
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
            throw CannotExecuteSolutionForNonLocalIp::make();
        }

        return $this;
    }
}
