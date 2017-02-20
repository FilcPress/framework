<?php

namespace FilcPress\ACF\Options;

trait MinimumSizeOption
{
    protected $minSize = 0;

    public function minSize($minSize)
    {
        $this->minSize = $minSize;

        return $this;
    }

    protected function getMinSize()
    {
        return [
            'min_size' => $this->minSize,
        ];
    }
}
