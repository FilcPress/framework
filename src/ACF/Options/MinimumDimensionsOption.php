<?php

namespace FilcPress\ACF\Options;

trait MinimumDimensionsOption
{
    protected $minWidth = 0;

    protected $minHeight = 0;

    public function minWidth($minWidth)
    {
        $this->minWidth = $minWidth;

        return $this;
    }

    public function minHeight($minHeight)
    {
        $this->minHeight = $minHeight;

        return $this;
    }

    protected function getMinimumDimensions()
    {
        return [
            'min_width' => $this->minWidth,
            'min_height' => $this->minHeight,
        ];
    }
}
