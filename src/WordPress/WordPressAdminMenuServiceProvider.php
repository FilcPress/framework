<?php

namespace FilcPress\WordPress;

use Illuminate\Support\ServiceProvider;

class WordPressAdminMenuServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        add_action('admin_menu', [$this, 'removeMenuItems']);
    }

    /**
     * Remove unnecessary menu items from admin panel.
     */
    public function removeMenuItems()
    {
        remove_submenu_page('themes.php', 'themes.php');
        global $submenu;
        unset($submenu['themes.php'][6]); // Customize link
    }
}
