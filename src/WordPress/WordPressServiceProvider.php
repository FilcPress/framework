<?php

namespace FilcPress\WordPress;

use Illuminate\Support\ServiceProvider;

class WordPressServiceProvider extends ServiceProvider
{
    protected $loadTheme = false;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->isCli()) {
            return;
        }

        if ($this->shouldLoadTheme()) {
            // Load the theme template.
            require_once(ABSPATH.WPINC.'/template-loader.php');
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
        if ($this->isCli()) {
            return;
        }

        $this->registerAdminMenuManager();

        if ($this->shouldReinitializeWordpress()) {
            require(dirname(ABSPATH).'/wp-config.php');
            return;
        }

        if ($this->wordpressInitialized()) {
            /**
             * If wordpress is already initialized, don't do it again.
             */
            return;
        }

        define('WP_USE_THEMES', true);
        // Load the WordPress library.
        require(config('wordpress.path').'/wp-load.php');
        // Set up the WordPress query.
        wp();

        $this->setThemeToBeLoaded();
    }

    /**
     * Register the admin menu manager instance.
     *
     * @return void
     */
    protected function registerAdminMenuManager()
    {
        $this->app->singleton('adminMenu', function ($app) {
            return new AdminMenu($app);
        });
    }

    /**
     * Check whether WordPress should be reinitialized.
     *
     * @return bool
     */
    private function shouldReinitializeWordpress()
    {
        return defined('FILCPRESS_REINITIALIZE_WORDPRESS');
    }

    /**
     * Checks whether WordPress has already been initialized. For example, when wp-load.php
     * has been loaded, then it means that WordPress has been initialized. This includes
     * wp-admin, wp-cron and wp-login as entry points and possibly all other WP ones.
     *
     * @return bool
     */
    private function wordpressInitialized()
    {
        return defined('ABSPATH');
    }

    private function shouldLoadTheme()
    {
        return $this->loadTheme;
    }

    private function setThemeToBeLoaded()
    {
        $this->loadTheme = true;
    }

    private function isCli()
    {
        return php_sapi_name() === 'cli';
    }
}
