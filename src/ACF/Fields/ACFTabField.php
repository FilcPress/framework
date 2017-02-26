<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\EndpointOption;
use FilcPress\ACF\Options\PlacementOption;

class ACFTabField extends ACFField
{
    use PlacementOption, EndpointOption;

    protected $type = 'tab';

    /**
     * End tabs section. Following fields will be outside of tabs group scope.
     *
     * @return $this
     */
    public function endTabs()
    {
        $this->label('');
        $this->endpoint();

        return $this;
    }
}
