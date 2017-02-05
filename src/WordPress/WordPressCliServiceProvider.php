<?php

namespace FilcPress\WordPress;

use Illuminate\Support\ServiceProvider;

class WordPressCliServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->isCli()) {
            return;
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (! $this->isCli()) {
            return;
        }

        // Load the WordPress library.
        require(config('wordpress.path').'/wp-load.php');
    }

    private function isCli()
    {
        return php_sapi_name() === 'cli';
    }
}
