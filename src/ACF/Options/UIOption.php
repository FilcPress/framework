<?php

namespace FilcPress\ACF\Options;

trait UIOption
{
    protected $ui = 0;

    public function UI($ui = 1)
    {
        $this->ui = $ui;

        return $this;
    }

    protected function getUI()
    {
        return [
            'ui' => $this->ui,
        ];
    }
}
