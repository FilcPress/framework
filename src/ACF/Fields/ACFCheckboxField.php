<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\LayoutOption;
use FilcPress\ACF\Options\ToggleOption;
use FilcPress\ACF\Options\ChoicesOption;
use FilcPress\ACF\Options\SaveCustomOption;
use FilcPress\ACF\Options\AllowCustomOption;
use FilcPress\ACF\Options\DefaultValueOption;
use FilcPress\ACF\Options\ReturnFormatOption;

class ACFCheckboxField extends ACFField
{
    use ChoicesOption, AllowCustomOption, SaveCustomOption, DefaultValueOption, LayoutOption, ToggleOption, ReturnFormatOption;

    protected $type = 'checkbox';

    public function __construct($id)
    {
        $this->layoutVertical();

        parent::__construct($id);
    }
}
