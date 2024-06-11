<?php

namespace Spatie\LaravelErrorSolutions\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\LaravelErrorSolutions\LaravelErrorSolutions
 */
class LaravelErrorSolutions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Spatie\LaravelErrorSolutions\LaravelErrorSolutions::class;
    }
}
