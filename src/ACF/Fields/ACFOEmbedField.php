<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\WidthOption;
use FilcPress\ACF\Options\HeightOption;

class ACFOEmbedField extends ACFField
{
    use WidthOption, HeightOption;

    protected $type = 'oembed';

    public function __construct($id)
    {
        $this->width(640);
        $this->height(390);

        parent::__construct($id);
    }
}
