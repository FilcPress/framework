<?php

namespace FilcPress\Foundation;

use Illuminate\Foundation\Application as LaravelApplication;

class Application extends LaravelApplication
{
    /**
     * The FilcPress framework version.
     *
     * @var string
     */
    const VERSION = '0.3.1';

    /**
     * Get the path to the application "app" directory.
     *
     * @return string
     */
    public function path()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'theme';
    }

    /**
     * Check if FilcPress is in total control of the request.
     *
     * @return string
     */
    public function isFilcPressRequest() {
        return defined('FILCPRESS_ENTRY_POINT');
    }
}
