<?php

namespace FilcPress\ACF\Options;

trait ZoomOption
{
    protected $zoom = 14;

    public function zoom($zoom)
    {
        $this->zoom = $zoom;

        return $this;
    }

    protected function getZoom()
    {
        return [
            'zoom' => $this->zoom,
        ];
    }
}
