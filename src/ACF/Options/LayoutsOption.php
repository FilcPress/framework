<?php

namespace FilcPress\ACF\Options;

use FilcPress\ACF\ACFLayout;

trait LayoutsOption
{
    protected $layouts = [];

    public function layouts($layouts)
    {
        $this->layouts = $layouts;

        return $this;
    }

    public function addLayout(ACFLayout $layout)
    {
        $this->layouts[] = $layout;

        return $this;
    }

    protected function getLayouts()
    {
        return [
            'layouts' => array_map(function ($layout) {
                return $layout->get();
            }, $this->layouts),
        ];
    }
}
