<?php

namespace FilcPress\ACF\Options;

trait EscHtmlOption
{
    protected $escHtml = 0;

    public function escHtml($escHtml = 1)
    {
        $this->escHtml = $escHtml;

        return $this;
    }

    protected function getEscHtml()
    {
        return [
            'esc_html' => $this->escHtml,
        ];
    }
}
