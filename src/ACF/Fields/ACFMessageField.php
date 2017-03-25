<?php

namespace FilcPress\ACF\Fields;

use FilcPress\ACF\ACFField;
use FilcPress\ACF\Options\EscHtmlOption;
use FilcPress\ACF\Options\MessageOption;
use FilcPress\ACF\Options\NewLinesOption;

class ACFMessageField extends ACFField
{
    use MessageOption, NewLinesOption, EscHtmlOption;

    protected $type = 'message';

    public function __construct($id)
    {
        $this->newLinesWithParagraphs();

        parent::__construct($id);
    }
}
