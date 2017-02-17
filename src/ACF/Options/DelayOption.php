<?php

namespace FilcPress\ACF\Options;

trait DelayOption
{
    protected $delay = 0;

    public function delay($delay)
    {
        $this->delay = $delay;

        return $this;
    }

    public function delayed()
    {
        $this->delay = 1;

        return $this;
    }

    protected function getDelay()
    {
        return [
            'delay' => $this->delay,
        ];
    }
}
