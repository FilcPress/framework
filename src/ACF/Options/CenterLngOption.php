<?php

namespace FilcPress\ACF\Options;

trait CenterLngOption
{
    protected $centerLng = 24.753534;

    public function centerLng($centerLng)
    {
        $this->centerLng = $centerLng;

        return $this;
    }

    protected function getCenterLng()
    {
        return [
            'center_lng' => $this->centerLng,
        ];
    }
}
