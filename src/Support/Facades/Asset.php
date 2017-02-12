<?php

namespace FilcPress\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FilcPress\StaticAssets\StaticAssetsManager
 */
class Asset extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'asset';
    }
}
