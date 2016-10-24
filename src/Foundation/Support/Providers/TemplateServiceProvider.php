<?php

namespace FilcPress\Foundation\Support\Providers;

use FilcPress\Templating\TemplatesManager;
use FilcPress\Support\Facades\Template;
use FilcPress\Support\ServiceProvider;

class TemplateServiceProvider extends ServiceProvider
{
    /**
     * The controller namespace for the application.
     *
     * @var string|null
     */
    protected $namespace;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTemplates();

        $this->app->booted(function () {
            Template::getTemplates()->refreshNameLookups();
        });
    }

    /**
     * Load the application templates.
     *
     * @return void
     */
    protected function loadTemplates()
    {
        $this->app->call([$this, 'map']);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Pass dynamic methods onto the templates manager instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array(
            [$this->app->make(TemplatesManager::class), $method], $parameters
        );
    }
}
