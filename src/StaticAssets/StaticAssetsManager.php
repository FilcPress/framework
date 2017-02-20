<?php

namespace FilcPress\StaticAssets;

use Illuminate\Container\Container;

class StaticAssetsManager
{
    public function registerStylesheet($src, $name = 'theme')
    {
        add_action('wp_enqueue_scripts', function () use ($src, $name) {
            wp_register_style($name, url($src));
            wp_enqueue_style($name);
        });
    }
    public function registerScript($src, $name = 'theme')
    {
        add_action('wp_enqueue_scripts', function () use ($src, $name) {
            wp_register_script($name, url($src), null, null, true);
            wp_enqueue_script($name);
        });
    }
}
