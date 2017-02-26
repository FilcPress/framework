<?php

namespace FilcPress\ACF\Options;

trait AddTermOption
{
    protected $addTerm = 1;

    public function addTerm($addTerm)
    {
        $this->addTerm = $addTerm;

        return $this;
    }

    public function disableAddTerm()
    {
        $this->addTerm = 0;

        return $this;
    }

    protected function getAddTerm()
    {
        return [
            'add_term' => $this->addTerm,
        ];
    }
}
