<?php

namespace FilcPress\ACF\Options;

trait PostTypeOption
{
    protected $postType = [];

    public function postTypes($postTypes)
    {
        $this->postType = $postTypes;

        return $this;
    }

    public function addPostType($postType)
    {
        $this->postType[] = $postType;

        return $this;
    }

    public function addPostTypePage()
    {
        return $this->addPostType('page');
    }

    public function addPostTypePost()
    {
        return $this->addPostType('post');
    }

    protected function getPostType()
    {
        return [
            'post_type' => $this->postType,
        ];
    }
}
