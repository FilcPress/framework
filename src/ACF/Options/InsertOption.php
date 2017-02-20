<?php

namespace FilcPress\ACF\Options;

trait InsertOption
{
    protected $insert = 'append';

    public function insert($insert)
    {
        $this->insert = $insert;

        return $this;
    }

    public function insertPrepend()
    {
        $this->insert = 'prepend';

        return $this;
    }

    protected function getInsert()
    {
        return [
            'insert' => $this->insert,
        ];
    }
}
