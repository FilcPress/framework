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

    public function displayGroup()
    {
        $this->display = 'group';

        return $this;
    }

    public function displaySeamless()
    {
        $this->display = 'seamless';

        return $this;
    }

    protected function getDisplay()
    {
        return [
            'display' => $this->display,
        ];
    }
}
