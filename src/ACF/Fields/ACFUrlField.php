<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\AppendOption;
use FilcPress\ACF\Options\PrependOption;
use FilcPress\ACF\Options\PlaceholderOption;
use FilcPress\ACF\Options\DefaultValueOption;
use FilcPress\ACF\Options\CharacterLimitOption;

class ACFUrlField extends ACFField
{
    use DefaultValueOption, PlaceholderOption;

    protected $type = 'url';
}
