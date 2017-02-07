<?php

namespace FilcPress\Foundation\Providers;

use Illuminate\Foundation\Providers\ComposerServiceProvider;
use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider as LaravelConsoleSupportServiceProvider;

class ConsoleSupportServiceProvider extends LaravelConsoleSupportServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        ArtisanServiceProvider::class,
        ComposerServiceProvider::class,
    ];
}
