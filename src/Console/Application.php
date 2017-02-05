<?php

namespace FilcPress\Console;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use Illuminate\Console\Application as LaravelApplication;

class Application extends LaravelApplication
{
    /**
     * Create a new Artisan console application.
     *
     * @param  \Illuminate\Contracts\Container\Container  $laravel
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @param  string  $version
     * @return void
     */
    public function __construct(Container $laravel, Dispatcher $events, $version)
    {
        call_user_func([get_parent_class(get_parent_class($this)), '__construct'], 'FilcPress Framework', $version);

        $this->laravel = $laravel;
        $this->setAutoExit(false);
        $this->setCatchExceptions(false);

        $events->dispatch(new \Illuminate\Console\Events\ArtisanStarting($this));

        $this->bootstrap();
    }
}
