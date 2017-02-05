<?php

namespace FilcPress\Foundation\Console;

use Illuminate\Contracts\Events\Dispatcher;
use FilcPress\Console\Application as Artisan;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Console\Kernel as LaravelKernel;

class Kernel extends LaravelKernel
{
    /**
     * Get the Artisan application instance.
     *
     * @return \Illuminate\Console\Application
     */
    protected function getArtisan()
    {
        if (is_null($this->artisan)) {
            return $this->artisan = (new Artisan($this->app, $this->events, $this->app->version()))
                ->resolveCommands($this->commands);
        }

        return $this->artisan;
    }
}
