<?php

namespace FilcPress\ACF\Options;

trait DisplayOption
{
    protected $display = '';

    public function display($display)
    {
        $this->display = $display;

        return $this;
    }

    public function displayTable()
    {
        $this->display = 'table';

        return $this;
    }

    public function displayBlock()
    {
        $this->display = 'block';

        return $this;
    }

    public function displayRow()
    {
        $this->display = 'row';

        return $this;
    }

    protected function getDisplay()
    {
        return [
            'display' => $this->display,
        ];
    }
}
