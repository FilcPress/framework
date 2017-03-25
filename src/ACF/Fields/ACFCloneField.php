<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\CloneOption;
use FilcPress\ACF\Options\DisplayOption;
use FilcPress\ACF\Options\PrefixNameOption;
use FilcPress\ACF\Options\PrefixLabelOption;

class ACFCloneField extends ACFField
{
    use CloneOption, DisplayOption, PrefixLabelOption, PrefixNameOption;

    protected $type = 'clone';

    public function __construct($id)
    {
        $this->displaySeamless();

        parent::__construct($id);
    }
}
