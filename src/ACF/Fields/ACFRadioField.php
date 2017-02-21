<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\LayoutOption;
use FilcPress\ACF\Options\ChoicesOption;
use FilcPress\ACF\Options\AllowNullOption;
use FilcPress\ACF\Options\OtherChoiceOption;
use FilcPress\ACF\Options\DefaultValueOption;
use FilcPress\ACF\Options\ReturnFormatOption;
use FilcPress\ACF\Options\SaveOtherChoiceOption;

class ACFRadioField extends ACFField
{
    use ChoicesOption, AllowNullOption, OtherChoiceOption, SaveOtherChoiceOption, DefaultValueOption, LayoutOption,
        ReturnFormatOption;

    protected $type = 'radio';
}
