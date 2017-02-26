<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\FiltersOption;
use FilcPress\ACF\Options\MaximumOption;
use FilcPress\ACF\Options\MinimumOption;
use FilcPress\ACF\Options\ElementsOption;
use FilcPress\ACF\Options\PostTypeOption;
use FilcPress\ACF\Options\TaxonomyOption;
use FilcPress\ACF\Options\ReturnFormatOption;

class ACFRelationshipField extends ACFField
{
    use PostTypeOption, TaxonomyOption, FiltersOption, ElementsOption, MinimumOption, MaximumOption, ReturnFormatOption;

    protected $type = 'relationship';

    public function __construct($id)
    {
        $this->returnFormatObject();

        parent::__construct($id);
    }
}
