<?php

namespace FilcPress\ACF\Options;

trait ElementsOption
{
    protected $elements = [];

    public function elements($elements)
    {
        $this->elements = $elements;

        return $this;
    }

    public function addElement($element)
    {
        $this->elements[] = $element;

        return $this;
    }

    protected function getElements()
    {
        return [
            'elements' => $this->elements,
        ];
    }
}
