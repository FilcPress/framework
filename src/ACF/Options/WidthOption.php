<?php

namespace FilcPress\ACF\Options;

trait WidthOption
{
    protected $width = '';

    public function width($width)
    {
        $this->width = $width;

        return $this;
    }

    protected function getWidth()
    {
        return [
            'width' => $this->width,
        ];
    }
}
