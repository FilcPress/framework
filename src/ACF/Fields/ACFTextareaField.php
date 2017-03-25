<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\RowsOption;
use FilcPress\ACF\Options\NewLinesOption;
use FilcPress\ACF\Options\PlaceholderOption;
use FilcPress\ACF\Options\DefaultValueOption;
use FilcPress\ACF\Options\CharacterLimitOption;

class ACFTextareaField extends ACFField
{
    use DefaultValueOption, PlaceholderOption, CharacterLimitOption, RowsOption, NewLinesOption;

    protected $type = 'textarea';
}
