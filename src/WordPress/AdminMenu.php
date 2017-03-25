<?php

namespace FilcPress\WordPress;

class AdminMenu
{
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
