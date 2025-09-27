<?php

namespace SextaNet\LaravelFiles\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SextaNet\LaravelFiles\LaravelFiles
 */
class LaravelFiles extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SextaNet\LaravelFiles\LaravelFiles::class;
    }
}
