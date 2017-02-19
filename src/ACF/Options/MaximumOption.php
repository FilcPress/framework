<?php

namespace FilcPress\ACF\Options;

trait MaximumOption
{
    protected $maxWidth = 0;

    protected $maxHeight = 0;

    protected $maxSize = 0;

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

    public function maxSize($maxSize)
    {
        $this->maxSize = $maxSize;

        return $this;
    }

    protected function getMaximums()
    {
        return [
            'max_width' => $this->maxWidth,
            'max_height' => $this->maxHeight,
            'max_size' => $this->maxSize,
        ];
    }
}
