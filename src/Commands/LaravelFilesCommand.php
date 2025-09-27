<?php

namespace SextaNet\LaravelFiles\Commands;

use Illuminate\Console\Command;

class LaravelFilesCommand extends Command
{
    public $signature = 'laravel-files';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
