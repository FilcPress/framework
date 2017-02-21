<?php

namespace FilcPress\ACF\Options;

trait SaveCustomOption
{
    protected $saveCustom = 0;

    public function saveCustom($saveCustom = 1)
    {
        $this->saveNull = $saveCustom;

        return $this;
    }

    protected function getSaveCustom()
    {
        return [
            'save_custom' => $this->saveCustom,
        ];
    }
}
