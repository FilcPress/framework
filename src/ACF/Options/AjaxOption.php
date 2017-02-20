<?php

namespace FilcPress\ACF\Options;

trait AjaxOption
{
    protected $ajax = 0;

    public function ajax($ajax = 1)
    {
        $this->ajax = $ajax;

        return $this;
    }

    protected function getAjax()
    {
        return [
            'ajax' => $this->ajax,
        ];
    }
}
