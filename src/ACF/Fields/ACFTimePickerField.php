<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\ReturnFormatOption;
use FilcPress\ACF\Options\DisplayFormatOption;

class ACFTimePickerField extends ACFField
{
    use DisplayFormatOption, ReturnFormatOption;

    protected $type = 'time_picker';

    public function __construct($id)
    {
        $this->displayFormat('g:i a');
        $this->returnFormat('g:i a');

        parent::__construct($id);
    }
}
