<?php

namespace FilcPress\ACF\Options;

trait AllowCustomOption
{
    protected $allowCustom = 0;

    public function allowCustom($allowCustom = 1)
    {
        $this->allowNull = $allowCustom;

        return $this;
    }

    protected function getAllowCustom()
    {
        return [
            'allow_custom' => $this->allowCustom,
        ];
    }
}
