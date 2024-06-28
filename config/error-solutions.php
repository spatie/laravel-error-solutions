<?php

return [
    /**
     * Display solutions on the error page
     */
    'enabled' => true,

    /*
     * Enable or disable runnable solutions.
     *
     * Runnable solutions will only work in local development environments,
     * even if this flag is set to true.
     */
    'enable_runnable_solutions' => true,

    /*
     * The solution providers that should be used to generate solutions.
     *
     * First we load the default PHP and Laravel defaults provided by
     * the base error solution package, then we load the ones you provide here.
     */
    'solution_providers' => [
        'php',
        'laravel',
        // your solution provider classes
    ],

    /*
     * When a key is set, we'll send your exceptions to Open AI to generate a solution
     */
    'open_ai_key' => env('ERROR_SOLUTIONS_OPEN_AI_KEY'),

    /*
     * This class is responsible for determining if a solution is runnable.
     *
     * In most cases, you can use the default implementation.
     */
    'runnable_solutions_guard' => Spatie\LaravelErrorSolutions\Support\RunnableSolutionsGuard::class,
];
