<?php

namespace FilcPress\ACF\Options;

trait StepSizeOption
{
    protected $step = '';

    public function step($step)
    {
        $this->step = $step;

        return $this;
    }

    protected function getStep()
    {
        return [
            'step' => $this->step,
        ];
    }
}
