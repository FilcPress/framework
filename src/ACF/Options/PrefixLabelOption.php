<?php

namespace FilcPress\ACF\Options;

trait PrefixLabelOption
{
    protected $prefixLabel = 0;

    public function prefixLabel($prefixLabel = 1)
    {
        $this->prefixLabel = $prefixLabel;

        return $this;
    }

    protected function getPrefixLabel()
    {
        return [
            'prefix_label' => $this->prefixLabel,
        ];
    }
}
