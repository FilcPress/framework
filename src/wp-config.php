<?php

if (! function_exists('wp_config')) {
    function wp_config($wpConfigLocationFullPath)
    {
        /**
         * If FilcPress has not been initialized, initialize it and stop executing
         * this file. FilcPress will try to load wp-config.php again after the
         * core functionality of framework itself has been initialized.
         */
        if (! defined('FILCPRESS_FRAMEWORK_START')) {
            define('FILCPRESS_REINITIALIZE_WORDPRESS', true);
            require_once $wpConfigLocationFullPath.'/index.php';
            return;
        }

        // ===================================================
        // Load database info and local development parameters
        // ===================================================
        define('APP_DOMAIN', env('APP_DOMAIN'));
        define('APP_SECURE', (bool) env('APP_SECURE', true)); // is https enabled?

        define('DB_NAME', config('database.connections.'.config('database.default').'.database'));
        define('DB_USER', config('database.connections.'.config('database.default').'.username'));
        define('DB_PASSWORD', config('database.connections.'.config('database.default').'.password'));
        define('DB_HOST', config('database.connections.'.config('database.default').'.host')); // Probably 'localhost'

        // =========
        // Fake URLs
        // =========
        define('WP_HOME', (APP_SECURE ? 'https' : 'http').'://'.APP_DOMAIN);
        define('WP_SITEURL', (APP_SECURE ? 'https' : 'http').'://'.APP_DOMAIN.'/wp');

        // ========================
        // Custom Content Directory
        // ========================
        define('WP_CONTENT_DIR', $wpConfigLocationFullPath.'/content');
        define('WP_CONTENT_URL', (APP_SECURE ? 'https' : 'http').'://'.APP_DOMAIN.'/content');

        // ================================================
        // You almost certainly do not want to change these
        // ================================================
        define('DB_CHARSET', 'utf8');
        define('DB_COLLATE', '');


        // ========================
        // Change the default theme
        // ========================
        define('WP_DEFAULT_THEME', 'theme');

        // ====================
        // Enable theme loading
        // ====================
        define('WP_USE_THEMES', true);

        // =============================================================
        // Disable plugin installations, update, system updates and more
        // =============================================================
        define('DISALLOW_FILE_MODS', true);
        define('WP_AUTO_UPDATE_CORE', false);

        // ==============================================================
        // Salts, for security
        // Grab these from: https://api.wordpress.org/secret-key/1.1/salt
        // ==============================================================
        define('AUTH_KEY', 'aXu~O0S:We}}.)>%kEh D)Y;efi67is+bF*kPyl<yPYYUFct~-n/r-~F.CFltdm}');
        define('SECURE_AUTH_KEY', '8TRo2K*@,Y06f]2siCG-{y5,J]f{sMyJ&B1j#}kr9?qkZ=&bQUf30#OV-{}6i)<F');
        define('LOGGED_IN_KEY', 'z}YPXG63pbIWeW:0mg(2A X(Dn{Q,8Ym~0@[yb7Qr%0KV?d )K[r7,hIr|D0JK?k');
        define('NONCE_KEY', '/E*=r%-l-Bm%tOdm3LR#x,[b36+ !Z*a^a]0|5zVyqgX-g3X0~0`EV9=_Nk%O+?x');
        define('AUTH_SALT', 'T=]qx(~7t~ST|d+HNNQco%NYa_GE(/E[w()zM;kSb?1Z,+7-^H6`@>M|sH>A.,^-');
        define('SECURE_AUTH_SALT', '.>(z++rx&XAXtwUvh+GtBa`^#&u!?3bh&s6+Mc s~9=1l0X0(-ZfqX:ZfMez9-lH');
        define('LOGGED_IN_SALT', ',$-~H_~#bXvr@:nuv8ubOL.#(R}k87{ilw(_t*z?g)KE +!08@<mluY0HC0PAb)M');
        define('NONCE_SALT', 't26C^M2+YlhkH_PA-lQSt.)|!f{g} V$hs& gNstE}J}|G8T+-FJn@(yvXPw-,iS');

        // ==============================================================
        // Table prefix
        // Change this if you have multiple installs in the same database
        // ==============================================================
        $table_prefix = 'wp_';

        // ================================
        // Language
        // Leave blank for American English
        // ================================
        define('WPLANG', '');

        // ===========
        // Hide errors
        // ===========
        if ((bool) env('APP_DEBUG') === true) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            define('WP_DEBUG_DISPLAY', true);
            define('SAVEQUERIES', true);
            define('WP_DEBUG', true);
        } else {
            ini_set('display_errors', 0);
            define('WP_DEBUG_DISPLAY', false);
        }

        // =================================================================
        // Debug mode
        // Debugging? Enable these. Can also enable them in local-config.php
        // =================================================================
        // define( 'SAVEQUERIES', true );
        // define( 'WP_DEBUG', true );

        // ======================================
        // Load a Memcached config if we have one
        // ======================================
        if (file_exists($wpConfigLocationFullPath.'/memcached.php')) {
            $memcached_servers = include($wpConfigLocationFullPath.'/memcached.php');
        }

        // ===========================================================================================
        // This can be used to programatically set the stage when deploying (e.g. production, staging)
        // ===========================================================================================
        define('WP_STAGE', '%%WP_STAGE%%');
        define('STAGING_DOMAIN', '%%WP_STAGING_DOMAIN%%'); // Does magic in WP Stack to handle staging domain rewriting

        // Lock file editing feature through admin area
        define('DISALLOW_FILE_EDIT', true);

        // ===================
        // Bootstrap WordPress
        // ===================
        if (! defined('ABSPATH')) {
            define('ABSPATH', $wpConfigLocationFullPath.'/wp/');
        }
        require_once(ABSPATH.'wp-settings.php');

        // Hide WordPress version
        if (! function_exists('remove_version')) {
            function remove_version()
            {
                return '';
            }
        }
        add_filter('the_generator', 'remove_version');
    }
}
