<?php

namespace FilcPress\WordPress;

use DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;

class WordPressServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAdminMenuManager();

        if ($this->isCli()) {
            if (! $this->isWordPressInstalled()) {
                $this->setWordPressStatusToInstalling();
            }

            // Set common headers, to prevent warnings from plugins
            $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.0';
            $_SERVER['SERVER_NAME'] = env('APP_DOMAIN', 'filcpress.dev');
            $_SERVER['HTTP_USER_AGENT'] = '';
            $_SERVER['REQUEST_METHOD'] = 'GET';
            $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        }

        if (! $this->isCli() && $this->shouldReinitializeWordpress()) {
            require(dirname(ABSPATH).'/wp-config.php');
            return;
        }

        if ($this->wordpressInitialized()) {
            /**
             * If wordpress is already initialized, don't do it again.
             */
            return;
        }
        
        define('FILCPRESS_ENTRY_POINT', true);

        // Load the WordPress library.
        require(config('wordpress.path').'/wp-load.php');
    }

    /**
     * Register the admin menu manager instance.
     *
     * @return void
     */
    protected function registerAdminMenuManager()
    {
        $this->app->singleton('adminMenu', function () {
            return new AdminMenu;
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

    private function isCli()
    {
        return php_sapi_name() === 'cli';
    }

    private function isWordPressInstalled()
    {
        try {
            DB::table('wp_options')->where('option_name', 'siteurl')->first();
        } catch (QueryException $e) {
            return false;
        }

        return true;
    }

    private function setWordPressStatusToInstalling()
    {
        define('WP_INSTALLING', true);
    }
}
