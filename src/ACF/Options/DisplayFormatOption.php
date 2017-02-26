<?php

namespace FilcPress\ACF\Options;

trait DisplayFormatOption
{
    protected $displayFormat;

    public function displayFormat($displayFormat)
    {
        $this->displayFormat = $displayFormat;

        return $this;
    }

    protected function getDisplayFormat()
    {
        return [
            'display_format' => $this->displayFormat,
        ];
    }
}
