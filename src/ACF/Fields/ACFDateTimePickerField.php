<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\FirstDayOption;
use FilcPress\ACF\Options\ReturnFormatOption;
use FilcPress\ACF\Options\DisplayFormatOption;

class ACFDateTimePickerField extends ACFField
{
    use DisplayFormatOption, ReturnFormatOption, FirstDayOption;

    protected $type = 'date_time_picker';

    public function __construct($id)
    {
        $this->displayFormat('d/m/Y g:i a');
        $this->returnFormat('d/m/Y g:i a');

        parent::__construct($id);
    }
}
