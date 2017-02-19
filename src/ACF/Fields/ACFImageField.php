<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\LibraryOption;
use FilcPress\ACF\Options\MaximumOption;
use FilcPress\ACF\Options\MinimumOption;
use FilcPress\ACF\Options\MimeTypesOption;
use FilcPress\ACF\Options\PreviewSizeOption;
use FilcPress\ACF\Options\ReturnFormatOption;

class ACFImageField extends ACFField
{
    use ReturnFormatOption, PreviewSizeOption, LibraryOption, MinimumOption, MaximumOption, MimeTypesOption;

    protected $type = 'image';

    public function __construct()
    {
        $this->returnFormat('array');
    }
}
