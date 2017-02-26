<?php

namespace FilcPress\ACF\Options;

trait CloneOption
{
    protected $clone = [];

    public function cloneGroup($key)
    {
        $this->clone[] = 'group_'.$key;

        return $this;
    }

    public function cloneField($key)
    {
        $this->clone[] = $key;

        return $this;
    }

    protected function getClone()
    {
        return [
            'clone' => $this->clone,
        ];
    }
}
