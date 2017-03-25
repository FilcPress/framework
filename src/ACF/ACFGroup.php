<?php

namespace FilcPress\ACF;

use RuntimeException;

class ACFGroup
{
    protected $id;

    protected $title;

    protected $fields = [];

    protected $locations = [];

    protected $menuOrder = 0;

    protected $position = 'normal';

    protected $style = 'default';

    protected $labelPlacement = 'top';

    protected $instructionPlacement = 'label';

    protected $hideOnScreen = [];

    protected $hideAll = [
        'the_content',
        'excerpt',
        'custom_fields',
        'discussion',
        'comments',
        'revisions',
        'author',
        'format',
        'categories',
        'tags',
        'send-trackbacks',
    ];

    protected $validate = true;

    public function __construct($id)
    {
        $this->id = 'group_'.$id;
        $this->title = $id;
    }

    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    public function addField($field)
    {
        $this->fields[] = $field;

        return $this;
    }

    public function addLocation($location)
    {
        $this->locations[] = $location;

        return $this;
    }

    public function menuOrder($menuOrder)
    {
        $this->menuOrder = $menuOrder;

        return $this;
    }

    public function positionAfterTitle()
    {
        $this->position = 'acf_after_title';

        return $this;
    }

    public function positionOnSide()
    {
        $this->position = 'side';

        return $this;
    }

    public function seamless()
    {
        $this->style = 'seamless';

        return $this;
    }

    public function fieldLabelsOnLeft()
    {
        $this->labelPlacement = 'left';

        return $this;
    }

    public function fieldInstructionsBelowFields()
    {
        $this->instructionPlacement = 'field';

        return $this;
    }

    public function hide($element)
    {
        $this->hideOnScreen[] = $element;

        return $this;
    }

    public function hideAll()
    {
        $this->hideOnScreen = $this->hideAll;
    }

    public function disableValidation()
    {
        $this->validate = false;

        return $this;
    }

    public function register()
    {
        if ($this->validate) {
            $this->validate();
        }

        if (function_exists('acf_add_local_field_group')) {
            add_action('init', function () {
                acf_add_local_field_group($this->getGroupOptions());
            });
        } else {
            throw new RuntimeException('Function "acf_add_local_field_group()" is not available. ACF PRO plugin is probably not installed or activated.');
        }
    }

    protected function getGroupOptions()
    {
        return [
            'key' => $this->id,
            'title' => $this->title,
            'fields' => $this->getFields(),
            'location' => $this->getLocations(),
            'menu_order' => $this->menuOrder,
            'position' => $this->position,
            'style' => $this->style,
            'label_placement' => $this->labelPlacement,
            'instruction_placement' => $this->instructionPlacement,
            'hide_on_screen' => $this->fields,
        ];
    }

    protected function validate() {
        $this->validateLocations();
        $this->validateFields();
    }

    protected function validateLocations()
    {
        if (count($this->locations) === 0) {
            throw new RuntimeException('ACFGroup "'.$this->id.'" has no locations defined.');
        }
    }

    protected function validateFields()
    {
        if (count($this->fields) === 0) {
            throw new RuntimeException('ACFGroup "'.$this->id.'" has no fields defined.');
        }
    }

    protected function getFields()
    {
        return array_map(function ($field) {
            return $field->get();
        }, $this->fields);
    }

    protected function getLocations()
    {
        return array_map(function ($location) {
            return $location->get();
        }, $this->locations);
    }
}
