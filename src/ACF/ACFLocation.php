<?php

namespace FilcPress\ACF;

class ACFLocation
{
    protected $location = [];

    protected $currentParam = null;

    protected $currentOperator = null;

    protected $currentValue = null;

    public function param($param)
    {
        $this->currentParam = $param;

        return $this;
    }

    public function equals($value)
    {
        $this->currentOperator = '==';
        $this->currentValue = $value;

        $this->push();

        return $this;
    }

    public function notEquals($value)
    {
        $this->currentOperator = '!=';
        $this->currentValue = $value;

        $this->push();

        return $this;
    }

    public function is($value)
    {
        return $this->equals($value);
    }

    public function isNot($value)
    {
        return $this->notEquals($value);
    }

    protected function push()
    {
        $this->location[] = [
            'param' => $this->currentParam,
            'operator' => $this->currentOperator,
            'value' => $this->currentValue,
        ];

        $this->currentParam = null;
        $this->currentOperator = null;
        $this->currentValue = null;

        return $this;
    }

    public function get()
    {
        return $this->location;
    }

    public function postType()
    {
        $this->currentParam = 'post_type';

        return $this;
    }

    public function isPage()
    {
        return $this->postType()->is('page');
    }

    public function isNotPage()
    {
        return $this->postType()->isNot('page');
    }

    public function isPost()
    {
        return $this->postType()->is('post');
    }

    public function isNotPost()
    {
        return $this->postType()->isNot('post');
    }

    public function postStatus()
    {
        return $this->param('post_status');
    }

    public function postFormat()
    {
        return $this->param('post_format');
    }

    public function postCategory()
    {
        return $this->param('post_category');
    }

    public function postTaxonomy()
    {
        return $this->param('post_taxonomy');
    }

    public function pageTemplate()
    {
        return $this->param('page_template');
    }

    public function pageType()
    {
        return $this->param('page_type');
    }

    public function isFrontPage()
    {
        return $this->param('page_type')->is('front_page');
    }

    public function isPostsPage()
    {
        return $this->param('page_type')->is('posts_page');
    }

    public function isTopLevelPage()
    {
        return $this->param('page_type')->is('top_level');
    }

    public function isNotTopLevelPage()
    {
        return $this->param('page_type')->isNot('top_level');
    }

    public function isParentPage()
    {
        return $this->param('page_type')->is('parent');
    }

    public function isChildPage()
    {
        return $this->param('page_type')->is('child');
    }

    public function pageParent()
    {
        return $this->param('page_parent');
    }

    public function page()
    {
        return $this->param('page');
    }

    public function currentUser()
    {
        return $this->param('current_user');
    }

    public function currentUserRole()
    {
        return $this->param('current_user_role');
    }

    public function userForm()
    {
        return $this->param('user_form');
    }

    public function userRole()
    {
        return $this->param('user_role');
    }

    public function attachment()
    {
        return $this->param('attachment');
    }

    public function taxonomy()
    {
        return $this->param('taxonomy');
    }

    public function comment()
    {
        return $this->param('comment');
    }

    public function widget()
    {
        return $this->param('widget');
    }

    public function isOptionsPage()
    {
        return $this->param('options_page')->is('acf-options');
    }
}
