<?php

namespace FilcPress\ACF\Options;

trait ToggleOption
{
    protected $toggle = 0;

    public function toggle($toggle = 1)
    {
        $this->toggle = $toggle;

        return $this;
    }

    protected function getToggle()
    {
        return [
            'toggle' => $this->toggle,
        ];
    }
}
