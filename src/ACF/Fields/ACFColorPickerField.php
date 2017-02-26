<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\DefaultValueOption;

class ACFColorPickerField extends ACFField
{
    use DefaultValueOption;

    protected $type = 'color_picker';
}
