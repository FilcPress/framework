<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\LayoutsOption;
use FilcPress\ACF\Options\MaximumOption;
use FilcPress\ACF\Options\MinimumOption;
use FilcPress\ACF\Options\ButtonLabelOption;

class ACFFlexibleContentField extends ACFField
{
    use ButtonLabelOption, MinimumOption, MaximumOption, LayoutsOption;

    protected $type = 'flexible_content';
}
