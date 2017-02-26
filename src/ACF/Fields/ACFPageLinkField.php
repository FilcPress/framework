<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\MultipleOption;
use FilcPress\ACF\Options\PostTypeOption;
use FilcPress\ACF\Options\TaxonomyOption;
use FilcPress\ACF\Options\AllowNullOption;
use FilcPress\ACF\Options\AllowArchivesOption;

class ACFPageLinkField extends ACFField
{
    use PostTypeOption, TaxonomyOption, AllowNullOption, AllowArchivesOption, MultipleOption;

    protected $type = 'page_link';
}
