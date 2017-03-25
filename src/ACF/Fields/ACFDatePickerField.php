<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\FirstDayOption;
use FilcPress\ACF\Options\ReturnFormatOption;
use FilcPress\ACF\Options\DisplayFormatOption;

class ACFDatePickerField extends ACFField
{
    use DisplayFormatOption, ReturnFormatOption, FirstDayOption;

    protected $type = 'date_picker';

    public function __construct($id)
    {
        $this->displayFormat('d/m/Y');
        $this->returnFormat('d/m/Y');

        parent::__construct($id);
    }
}
