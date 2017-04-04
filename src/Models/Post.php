<?php

namespace FilcPress\Models;

use WP_Post;

class Post
{
    /**
     * @var WP_Post
     */
    public $post;

    /**
     * @param WP_Post $post
     */
    public function __construct(WP_Post $post)
    {
        $this->post = $post;
    }

    public function title()
    {
        if ($this instanceof CurrentPost) {
            return get_the_title();
        }
        return null;
    }

    public function content()
    {
        the_post();
        if ($this instanceof CurrentPost) {
            return get_the_content();
        }
        return null;
    }

    public function field($fieldName, $formatValue = null)
    {
        return get_field($fieldName, $this->post->ID, $formatValue);
    }
}
