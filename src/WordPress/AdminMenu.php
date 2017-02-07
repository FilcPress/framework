<?php

namespace FilcPress\WordPress;

use Illuminate\Container\Container;

class AdminMenu
{
    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function hidePosts()
    {
        add_action('admin_menu', function () {
            remove_menu_page('edit.php');
        });
    }

    public function hideComments()
    {
        add_action('admin_menu', function () {
            remove_menu_page('edit-comments.php');
        });
    }
}
