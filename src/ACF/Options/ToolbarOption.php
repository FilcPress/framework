<?php

namespace FilcPress\ACF\Options;

trait ToolbarOption
{
    protected $toolbar = 'full';

    public function toolbar($toolbar)
    {
        $this->toolbar = $toolbar;

        return $this;
    }

    public function toolbarBasic()
    {
        $this->toolbar = 'basic';

        return $this;
    }

    protected function getToolbar()
    {
        return [
            'toolbar' => $this->toolbar,
        ];
    }
}
