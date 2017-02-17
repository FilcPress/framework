<?php

namespace FilcPress\ACF\Options;

trait HeightOption
{
    protected $height = '';

    public function height($height)
    {
        $this->height = $height;

        return $this;
    }

    protected function getHeight()
    {
        return [
            'height' => $this->height,
        ];
    }
}
