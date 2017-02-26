<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\LayoutOption;
use FilcPress\ACF\Options\MaximumOption;
use FilcPress\ACF\Options\MinimumOption;
use FilcPress\ACF\Options\CollapsedOption;
use FilcPress\ACF\Options\SubFieldsOption;
use FilcPress\ACF\Options\ButtonLabelOption;

class ACFRepeaterField extends ACFField
{
    use SubFieldsOption, CollapsedOption, MinimumOption, MaximumOption, LayoutOption, ButtonLabelOption;

    protected $type = 'repeater';

    public function __construct($id)
    {
        $this->layoutTable();

        parent::__construct($id);
    }
}
