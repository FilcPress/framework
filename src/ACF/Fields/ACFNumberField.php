<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\AppendOption;
use FilcPress\ACF\Options\MaximumOption;
use FilcPress\ACF\Options\MinimumOption;
use FilcPress\ACF\Options\PrependOption;
use FilcPress\ACF\Options\StepSizeOption;
use FilcPress\ACF\Options\PlaceholderOption;
use FilcPress\ACF\Options\DefaultValueOption;
use FilcPress\ACF\Options\CharacterLimitOption;

class ACFNumberField extends ACFField
{
    use DefaultValueOption, PlaceholderOption, PrependOption, AppendOption, CharacterLimitOption, MinimumOption,
        MaximumOption, StepSizeOption;

    protected $type = 'number';
}
