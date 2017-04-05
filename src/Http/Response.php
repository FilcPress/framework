<?php

namespace FilcPress\Http;

use Illuminate\Http\Response as LaravelResponse;

class Response extends LaravelResponse
{
    public function send()
    {
        if (defined('FILCPRESS_ENTRY_POINT')) {
            parent::send();
        }
    }
}
