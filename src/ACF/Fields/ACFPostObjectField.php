<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\MultipleOption;
use FilcPress\ACF\Options\PostTypeOption;
use FilcPress\ACF\Options\TaxonomyOption;
use FilcPress\ACF\Options\AllowNullOption;
use FilcPress\ACF\Options\ReturnFormatOption;

class ACFPostObjectField extends ACFField
{
    use PostTypeOption, TaxonomyOption, AllowNullOption, MultipleOption, ReturnFormatOption;

    protected $type = 'post_object';

    public function __construct($id)
    {
        $this->returnFormatObject();

        parent::__construct($id);
    }
}
