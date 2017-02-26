<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\RoleOption;
use FilcPress\ACF\Options\MultipleOption;
use FilcPress\ACF\Options\AllowNullOption;

class ACFUserField extends ACFField
{
    use RoleOption, AllowNullOption, MultipleOption;

    protected $type = 'user';
}
