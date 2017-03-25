<?php

namespace FilcPress\ACF\Options;

trait CenterLatOption
{
    protected $centerLat = 59.436997;

    public function centerLat($centerLat)
    {
        $this->centerLat = $centerLat;

        return $this;
    }

    protected function getCenterLat()
    {
        return [
            'center_lat' => $this->centerLat,
        ];
    }
}
