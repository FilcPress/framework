<?php

namespace FilcPress\ACF\Options;

trait PrependOption
{
    protected $prepend = '';

    public function prepend($prepend)
    {
        $this->prepend = $prepend;

        return $this;
    }

    protected function getPrepend()
    {
        return [
            'prepend' => $this->prepend,
        ];
    }
}
