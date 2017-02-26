<?php

namespace FilcPress\ACF;

use Illuminate\Support\ServiceProvider;

class ACFServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->setGoogleMapsApiKey();
    }

    /**
     * Register Google API key for Google Maps JavaScript API related functionality.
     */
    protected function setGoogleMapsApiKey()
    {
        $apiKey = config('services.google_maps.key');

        if ($apiKey) {
            add_filter('acf/settings/google_api_key', function () use ($apiKey) {
                return $apiKey;
            });
        }
    }
}
