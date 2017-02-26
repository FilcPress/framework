<?php

namespace FilcPress\ACF\Options;

trait LayoutOption
{
    protected $layout = '';

    public function layout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    public function layoutHorizaontal()
    {
        $this->layout = 'horizontal';

        return $this;
    }

    public function layoutVertical()
    {
        $this->layout = 'vertical';

        return $this;
    }

    public function layoutTable()
    {
        $this->layout = 'table';

        return $this;
    }

    protected function getLayout()
    {
        return [
            'layout' => $this->layout,
        ];
    }
}
