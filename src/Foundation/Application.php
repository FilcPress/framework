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
    const VERSION = '0.3.2';

    /**
     * Check if FilcPress is in total control of the request.
     *
     * @return string
     */
    public function isFilcPressRequest() {
        return defined('FILCPRESS_ENTRY_POINT');
    }
}
