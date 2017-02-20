<?php

namespace FilcPress\ACF\Options;

trait ChoicesOption
{
    protected $choices = [];

    public function choices($choices)
    {
        $this->choices = $choices;

        return $this;
    }

    public function addChoice($value, $label = null)
    {
        $label = ! is_null($label) ? $label : $value;
        $this->choices[$value] = $label;

        return $this;
    }

    protected function getChoices()
    {
        return [
            'choices' => $this->choices,
        ];
    }
}
