<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\AddTermOption;
use FilcPress\ACF\Options\MultipleOption;
use FilcPress\ACF\Options\TaxonomyOption;
use FilcPress\ACF\Options\AllowNullOption;
use FilcPress\ACF\Options\FieldTypeOption;
use FilcPress\ACF\Options\LoadTermsOption;
use FilcPress\ACF\Options\SaveTermsOption;
use FilcPress\ACF\Options\ReturnFormatOption;

class ACFTaxonomyField extends ACFField
{
    use TaxonomyOption, FieldTypeOption, MultipleOption, AllowNullOption, AddTermOption, SaveTermsOption,
        LoadTermsOption, ReturnFormatOption;

    protected $type = 'taxonomy';

    public function __construct($id)
    {
        $this->taxonomy('category');
        $this->returnFormatId();

        parent::__construct($id);
    }
}
