<?php

namespace FilcPress\ACF\Options;

trait PlacementOption
{
    protected $placement = 'top';

    public function placement($placement)
    {
        $this->placement = $placement;

        return $this;
    }

    public function placementLeft()
    {
        $this->placement = 'left';

        return $this;
    }

    protected function getPlacement()
    {
        return [
            'placement' => $this->placement,
        ];
    }
}
