<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\TabsOption;
use FilcPress\ACF\Options\DelayOption;
use FilcPress\ACF\Options\ToolbarOption;
use FilcPress\ACF\Options\MediaUploadOption;
use FilcPress\ACF\Options\DefaultValueOption;

class ACFWysiwygField extends ACFField
{
    use DefaultValueOption, TabsOption, ToolbarOption, MediaUploadOption, DelayOption;

    protected $type = 'wysiwyg';
}
