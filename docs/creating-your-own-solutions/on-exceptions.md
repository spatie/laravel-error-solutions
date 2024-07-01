---
title: On exceptions
weight: 3
---

The easiest way of adding a solution would to implement the `ProvidesSolution` interface on  your exception.

Here's an example that use an anonymous class to implement the `Solution` interface:

```php
use Exception;
use Spatie\ErrorSolutions\Contracts\Solution;
use Spatie\ErrorSolutions\Contracts\ProvidesSolution;

class ExceptionWithSolution extends Exception implements ProvidesSolution
{
    public function __construct(string $message = '')
    {
        parent::__construct($message ?? 'My custom exception');
    }

    public function getSolution(): Solution
    {
        return new class implements Solution
        {
            public function getSolutionTitle(): string
            {
                return 'My custom solution';
            }

            public function getSolutionDescription(): string
            {
                return 'My custom solution description';
            }

            public function getDocumentationLinks(): array
            {
                return [
                    'Spatie docs' => 'https://spatie.be/docs',
                ];
            }
        };
    }
}
```

Of course, you could also use [a separate solution class]():

```php
use Exception;
use Spatie\ErrorSolutions\Contracts\Solution;
use Spatie\ErrorSolutions\Contracts\ProvidesSolution;

class ExceptionWithSolution extends Exception implements ProvidesSolution
{
    public function __construct(string $message = '')
    {
        parent::__construct($message ?? 'My custom exception');
    }

    public function getSolution(): Solution
    {
        return YourSolution::class,
    }
}
```
