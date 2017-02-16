<?php

namespace FilcPress\ACF;

abstract class ACFField
{
    protected $id;

    protected $label;

    protected $name;

    protected $instructions = '';

    protected $required = 0;

    protected $conditions = [];

    protected $wrapper = [
        'width' => '',
        'class' => '',
        'id' => '',
    ];

    public function __construct($id)
    {
        $this->id = $id;
        $this->label = $id;
        $this->name = $id;
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

    public function instructions($instructions)
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function required()
    {
        $this->required = 1;

        return $this;
    }

    public function condition(ACFCondition $condition)
    {
        $this->conditions[] = $condition;

        return $this;
    }

    public function orCondition(ACFCondition $condition)
    {
        $this->condition($condition);

        return $this;
    }

    public function addCondition(ACFCondition $condition)
    {
        $this->condition($condition);

        return $this;
    }

    public function conditions(array $conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function wrapper($wrapper)
    {
        $this->wrapper = $wrapper;

        return $this;
    }

    public function wrapperWidth($width)
    {
        $this->wrapper['width'] = $width;

        return $this;
    }

    public function wrapperClass($class)
    {
        $this->wrapper['class'] = $class;

        return $this;
    }

    public function wrapperId($id)
    {
        $this->wrapper['id'] = $id;

        return $this;
    }

    protected function getCore() {
        return [
            'type' => $this->type,
            'key' => $this->id,
            'label' => $this->label,
            'name' => $this->name,
            'instructions' => $this->instructions,
            'required' => $this->required,
            'wrapper' => $this->wrapper,
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
