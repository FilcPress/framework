<?php

namespace FilcPress\ACF\Options;

trait MaximumSizeOption
{
    protected $maxSize = 0;

    public function maxSize($maxSize)
    {
        $this->maxSize = $maxSize;

        return $this;
    }

    protected function getMaximumSize()
    {
        return [
            'max_size' => $this->maxSize,
        ];
    }
}
