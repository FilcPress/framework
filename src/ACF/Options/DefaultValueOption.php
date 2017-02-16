<?php

namespace FilcPress\ACF\Options;

trait DefaultValueOption
{
    protected $defaultValue = '';

    public function defaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    protected function getDefaultValue()
    {
        return [
            'default_value' => $this->defaultValue,
        ];
    }
}
