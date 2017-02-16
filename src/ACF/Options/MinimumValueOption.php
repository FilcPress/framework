<?php

namespace FilcPress\ACF\Options;

trait MinimumValueOption
{
    protected $min = '';

    public function min($min)
    {
        $this->min = $min;

        return $this;
    }

    protected function getMin()
    {
        return [
            'min' => $this->min,
        ];
    }
}
