<?php

namespace FilcPress\ACF\Options;

trait MessageOption
{
    protected $message = '';

    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    protected function getMessage()
    {
        return [
            'message' => $this->message,
        ];
    }
}
