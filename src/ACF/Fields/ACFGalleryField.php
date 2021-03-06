<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\InsertOption;
use FilcPress\ACF\Options\LibraryOption;
use FilcPress\ACF\Options\MaximumOption;
use FilcPress\ACF\Options\MinimumOption;
use FilcPress\ACF\Options\MimeTypesOption;
use FilcPress\ACF\Options\MaximumSizeOption;
use FilcPress\ACF\Options\MinimumSizeOption;
use FilcPress\ACF\Options\MaximumDimensionsOption;
use FilcPress\ACF\Options\MinimumDimensionsOption;

class ACFGalleryField extends ACFField
{
    use MinimumOption, MaximumOption, InsertOption, LibraryOption, MinimumDimensionsOption, MinimumSizeOption,
        MaximumDimensionsOption, MaximumSizeOption, MimeTypesOption;

    protected $type = 'gallery';
}
