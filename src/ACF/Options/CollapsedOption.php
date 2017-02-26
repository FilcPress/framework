<?php

namespace FilcPress\ACF\Options;

trait CollapsedOption
{
    protected $collapsed = '';

    public function collapsed($collapsed)
    {
        $this->collapsed = $collapsed;

        return $this;
    }

    protected function getCollapsed()
    {
        return [
            'collapsed' => $this->collapsed,
        ];
    }
}
