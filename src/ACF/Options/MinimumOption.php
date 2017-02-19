<?php

namespace FilcPress\ACF\Options;

trait MinimumOption
{
    protected $minWidth = 0;

    protected $minHeight = 0;

    protected $minSize = 0;

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

    public function minSize($minSize)
    {
        $this->minSize = $minSize;

        return $this;
    }

    protected function getMinimums()
    {
        return [
            'min_width' => $this->minWidth,
            'min_height' => $this->minHeight,
            'min_size' => $this->minSize,
        ];
    }
}
