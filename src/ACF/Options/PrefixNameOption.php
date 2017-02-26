<?php

namespace FilcPress\ACF\Options;

trait PrefixNameOption
{
    protected $prefixName = 0;

    public function prefixName($prefixName = 1)
    {
        $this->prefixName = $prefixName;

        return $this;
    }

    protected function getPrefixName()
    {
        return [
            'prefix_name' => $this->prefixName,
        ];
    }
}
