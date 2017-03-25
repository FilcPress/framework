<?php

namespace FilcPress\ACF\Options;

trait ButtonLabelOption
{
    protected $buttonLabel = '';

    public function buttonLabel($buttonLabel)
    {
        $this->buttonLabel = $buttonLabel;

        return $this;
    }

    protected function getButtonLabel()
    {
        return [
            'button_label' => $this->buttonLabel,
        ];
    }
}
