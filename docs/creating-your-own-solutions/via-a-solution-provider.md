---
title: Via a solution provider
weight: 4
---

If you want to add solutions to exceptions that you can't modify, you can use a solution provider. A solution provider is a class that implements the `ProvidesSolution` interface. It will determine if it can provide a solution for a given exception.

Here's an example:

```php
use Spatie\ErrorSolutions\Contracts\HasSolutionsForThrowable;
use Spatie\ErrorSolutions\Contracts\Solution;
use Throwable;

class YourSolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        // return true if you can provide a solution for this exception
    }

    /**
     * @param \Throwable $throwable
     *
     * @return array<int, Solution>
     */
    public function getSolutions(Throwable $throwable): array
    {
        // return an array of solutions
    }
}
```

## Registering your solution provider

After you've created your solution provider, you can register it in the `solution_providers` key of the `error-solutions.php` config file:

```php
// config/error-solutions.php

return [
    'solution_providers' => [
        // other solution providers
        YourSolutionProvider::class,
    ],
];
```

Alternatively, you can register your solution provider at runtime. Typically, this would be done in a service provider:

```php
// app/Providers/YourServiceProvider.php

use Spatie\ErrorSolutions\ErrorSolutionsServiceProvider;
use Spatie\ErrorSolutions\Contracts\SolutionProviderRepository;

public function register()
{
    $repository = app(SolutionProviderRepository::class);
    
    $repository->registerSolutionProviders([
        YourSolutionProvider::class,
    ]);
}
```


