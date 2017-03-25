<?php

namespace FilcPress\ACF\Options;

trait MaximumOption
{
    protected $max = '';

    public function max($max)
    {
        $this->max = $max;

        return $this;
    }

    protected function getMax()
    {
        return [
            'max' => $this->max,
        ];
    }
}
