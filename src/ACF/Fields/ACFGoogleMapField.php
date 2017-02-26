<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\ZoomOption;
use FilcPress\ACF\Options\HeightOption;
use FilcPress\ACF\Options\CenterLatOption;
use FilcPress\ACF\Options\CenterLngOption;

class ACFGoogleMapField extends ACFField
{
    use CenterLatOption, CenterLngOption, ZoomOption, HeightOption;

    protected $type = 'google_map';

    public function __construct($id)
    {
        $this->height(400);

        parent::__construct($id);
    }
}
