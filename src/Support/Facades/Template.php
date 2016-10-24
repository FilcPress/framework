<?php

namespace FilcPress\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FilcPress\Templating\Template
 */
class Template extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'template';
    }
}
