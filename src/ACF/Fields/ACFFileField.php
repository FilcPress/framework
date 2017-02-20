<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\LibraryOption;
use FilcPress\ACF\Options\MimeTypesOption;
use FilcPress\ACF\Options\MaximumSizeOption;
use FilcPress\ACF\Options\MinimumSizeOption;
use FilcPress\ACF\Options\ReturnFormatOption;

class ACFFileField extends ACFField
{
    use ReturnFormatOption, LibraryOption, MinimumSizeOption, MaximumSizeOption, MimeTypesOption;

    protected $type = 'file';

    public function __construct()
    {
        $this->returnFormat('array');
    }
}
