<?php

namespace FilcPress\ACF\Options;

trait AppendOption
{
    protected $append = '';

    public function append($append)
    {
        $this->append = $append;

        return $this;
    }

    protected function getAppend()
    {
        return [
            'append' => $this->append,
        ];
    }
}
