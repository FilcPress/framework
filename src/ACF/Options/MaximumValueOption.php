<?php

namespace FilcPress\ACF\Options;

trait MaximumValueOption
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
