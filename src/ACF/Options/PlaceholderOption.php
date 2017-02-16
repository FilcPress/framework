<?php

namespace FilcPress\ACF\Options;

trait PlaceholderOption
{
    protected $placeholder = '';

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    protected function getPlaceholder()
    {
        return [
            'placeholder' => $this->placeholder,
        ];
    }
}
