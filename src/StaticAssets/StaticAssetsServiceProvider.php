<?php

namespace FilcPress\StaticAssets;

use Illuminate\Support\ServiceProvider;

class StaticAssetsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('asset', function () {
            return new StaticAssetsManager;
        });
    }
}
