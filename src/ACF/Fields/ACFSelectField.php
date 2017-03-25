<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\UIOption;
use FilcPress\ACF\Options\AjaxOption;
use FilcPress\ACF\Options\ChoicesOption;
use FilcPress\ACF\Options\MultipleOption;
use FilcPress\ACF\Options\AllowNullOption;
use FilcPress\ACF\Options\DefaultValueOption;

class ACFSelectField extends ACFField
{
    use ChoicesOption, DefaultValueOption, AllowNullOption, MultipleOption, UIOption, AjaxOption;

    protected $type = 'select';
}
