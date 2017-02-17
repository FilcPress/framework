<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\AppendOption;
use FilcPress\ACF\Options\PrependOption;
use FilcPress\ACF\Options\PlaceholderOption;
use FilcPress\ACF\Options\DefaultValueOption;
use FilcPress\ACF\Options\CharacterLimitOption;

class ACFPasswordField extends ACFField
{
    use PlaceholderOption, PrependOption, AppendOption;

    protected $type = 'password';
}
