<?php

use FilcPress\ACF\ACFGroup;
use FilcPress\ACF\ACFLocation;
use FilcPress\ACF\Fields\ACFTextField;

require_once(ABSPATH . 'wp-admin/includes/plugin.php');
activate_plugin('advanced-custom-fields-pro/acf.php');

(new ACFGroup('automated_test_acf'))
    ->title('Additional fields')
    ->addField((new ACFTextField('automated_test_acf_title'))->label('Title'))
    ->addLocation((new ACFLocation)->isPage())
    ->register();
