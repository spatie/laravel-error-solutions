---
title: Creating a solution class
weight: 2
---

A solution is a simple PHP class that implements the ` Spatie\ErrorSolutions\Contracts\Solution` interface.

Here's a simple example.

```php
class MySolution implements Solution
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
}
```

Optionally, you can add "provided by" information to a solution by implementing the methods.

```php
// in your solution class

public function solutionProvidedByName(): string
{
    return 'Flare';
}

public function solutionProvidedByLink(): string
{
    return 'https://flareapp.io';
}
```
