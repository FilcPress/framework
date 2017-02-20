<?php

namespace FilcPress\ACF\Options;

trait AllowNullOption
{
    protected $allowNull = 0;

    public function allowNull($allowNull = 1)
    {
        $this->allowNull = $allowNull;

        return $this;
    }

    protected function getAllowNull()
    {
        return [
            'allow_null' => $this->allowNull,
        ];
    }
}
