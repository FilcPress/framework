<?php

namespace FilcPress\WordPress;

use DB;
use Illuminate\Database\QueryException;
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

        if (! $this->isWordPressInstalled()) {
            $this->setWordPressStatusToInstalling();
        }

        // Set common headers, to prevent warnings from plugins
        $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.0';
        $_SERVER['SERVER_NAME'] = env('APP_DOMAIN', 'filcpress.dev');
        $_SERVER['HTTP_USER_AGENT'] = '';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        // Load the WordPress library.
        require(config('wordpress.path').'/wp-load.php');
    }

    private function isCli()
    {
        return php_sapi_name() === 'cli';
    }

    private function isWordPressInstalled()
    {
        try {
            $siteUrlRow = DB::table('wp_options')->where('option_name', 'siteurl')->first();
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
