<?php

namespace FilcPress\ACF\Options;

trait MaximumDimensionsOption
{
    protected $maxWidth = 0;

    protected $maxHeight = 0;

    public function maxWidth($maxWidth)
    {
        $this->maxWidth = $maxWidth;

        return $this;
    }

    public function maxHeight($maxHeight)
    {
        $this->maxHeight = $maxHeight;

        return $this;
    }

    protected function getMaximumDimensions()
    {
        return [
            'max_width' => $this->maxWidth,
            'max_height' => $this->maxHeight,
        ];
    }
}
