<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\PlaceholderOption;
use FilcPress\ACF\Options\DefaultValueOption;

class ACFUrlField extends ACFField
{
    use DefaultValueOption, PlaceholderOption;

    protected $type = 'url';
}
