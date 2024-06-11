<?php

namespace Spatie\LaravelErrorSolutions\Commands;

use Illuminate\Console\Command;

class LaravelErrorSolutionsCommand extends Command
{
    public $signature = 'laravel-error-solutions';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
