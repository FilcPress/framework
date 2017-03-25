<?php

namespace FilcPress\ACF\Options;

trait MultipleOption
{
    protected $multiple = 0;

    public function multiple($multiple = 1)
    {
        $this->multiple = $multiple;

        return $this;
    }

    protected function getMultiple()
    {
        return [
            'multiple' => $this->multiple,
        ];
    }
}
