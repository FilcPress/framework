<?php

namespace FilcPress\ACF\Options;

use FilcPress\ACF\ACFField;

trait SubFieldsOption
{
    protected $subFields = [];

    public function subFields($subFields)
    {
        $this->subFields = $subFields;

        return $this;
    }

    public function addSubField(ACFField $subField)
    {
        $this->subFields[] = $subField;

        return $this;
    }

    protected function getSubFields()
    {
        return [
            'sub_fields' => array_map(function ($field) {
                return $field->get();
            }, $this->subFields),
        ];
    }
}
