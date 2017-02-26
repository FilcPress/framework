<?php

namespace FilcPress\ACF\Options;

trait FieldTypeOption
{
    protected $fieldType = 'checkbox';

    public function fieldType($fieldType)
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    public function fieldTypeCheckbox()
    {
        $this->fieldType = 'checkbox';

        return $this;
    }

    public function fieldTypeRadio()
    {
        $this->fieldType = 'radio';

        return $this;
    }

    public function fieldTypeSelect()
    {
        $this->fieldType = 'select';

        return $this;
    }

    protected function getFieldType()
    {
        return [
            'field_type' => $this->fieldType,
        ];
    }
}
