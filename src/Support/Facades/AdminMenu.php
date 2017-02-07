<?php

namespace FilcPress\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FilcPress\WordPress\AdminMenu
 */
class AdminMenu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'adminMenu';
    }
}
