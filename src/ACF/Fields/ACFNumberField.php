<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\AppendOption;
use FilcPress\ACF\Options\PrependOption;
use FilcPress\ACF\Options\StepSizeOption;
use FilcPress\ACF\Options\PlaceholderOption;
use FilcPress\ACF\Options\DefaultValueOption;
use FilcPress\ACF\Options\MaximumValueOption;
use FilcPress\ACF\Options\MinimumValueOption;
use FilcPress\ACF\Options\CharacterLimitOption;

class ACFNumberField extends ACFField
{
    use DefaultValueOption, PlaceholderOption, PrependOption, AppendOption, CharacterLimitOption, MinimumValueOption,
        MaximumValueOption, StepSizeOption;

    protected $type = 'number';
}
