<?php

namespace FilcPress\Models;

class CurrentPost extends Post
{
    public function __construct()
    {
        global $post;

        parent::__construct($post);
    }
}
