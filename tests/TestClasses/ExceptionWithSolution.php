<?php

namespace Spatie\LaravelErrorSolutions\Tests\TestClasses;

use Exception;
use Spatie\ErrorSolutions\Contracts\ProvidesSolution;
use Spatie\ErrorSolutions\Contracts\Solution;

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
