<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\LibraryOption;
use FilcPress\ACF\Options\MimeTypesOption;
use FilcPress\ACF\Options\MaximumSizeOption;
use FilcPress\ACF\Options\MinimumSizeOption;
use FilcPress\ACF\Options\PreviewSizeOption;
use FilcPress\ACF\Options\ReturnFormatOption;
use FilcPress\ACF\Options\MaximumDimensionsOption;
use FilcPress\ACF\Options\MinimumDimensionsOption;

class ACFImageField extends ACFField
{
    use ReturnFormatOption, PreviewSizeOption, LibraryOption, MinimumDimensionsOption, MinimumSizeOption,
        MaximumDimensionsOption, MaximumSizeOption, MimeTypesOption;

    protected $type = 'image';

    public function __construct()
    {
        $this->returnFormat('array');
    }
}
