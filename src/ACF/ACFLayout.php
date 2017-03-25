<?php

namespace FilcPress\ACF;

use FilcPress\ACF\Options\DisplayOption;
use FilcPress\ACF\Options\MaximumOption;
use FilcPress\ACF\Options\MinimumOption;
use FilcPress\ACF\Options\SubFieldsOption;

class ACFLayout
{
    use DisplayOption, MinimumOption, MaximumOption, SubFieldsOption;

    protected $id;

    protected $label;

    protected $name;

    public function __construct($id)
    {
        $this->id = $id;
        $this->label = $id;
        $this->name = $id;

        $this->displayBlock();
    }

    public function label($label)
    {
        $this->label = $label;

        return $this;
    }

    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    protected function getCore() {
        return [
            'key' => $this->id,
            'label' => $this->label,
            'name' => $this->name,
        ];
    }

    public function get()
    {
        $allGetMethods = preg_grep('/^get(.+?)/', get_class_methods($this));
        return array_reduce($allGetMethods, function ($options, $option) {
            if (is_null($options)) {
                return $this->{$option}();
            }
            return array_merge($options, $this->{$option}());
        });
    }
}
