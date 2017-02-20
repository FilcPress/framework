<?php

namespace FilcPress\ACF\Options;

trait ReturnFormatOption
{
    protected $returnFormat = 'value';

    public function returnFormat($returnFormat)
    {
        $this->returnFormat = $returnFormat;

        return $this;
    }

    public function returnFormatUrl()
    {
        $this->returnFormat = 'url';

        return $this;
    }

    public function returnFormatId()
    {
        $this->returnFormat = 'id';

        return $this;
    }

    public function returnFormatLabel()
    {
        $this->returnFormat = 'label';

        return $this;
    }

    public function returnFormatArray()
    {
        $this->returnFormat = 'array';

        return $this;
    }

    protected function getReturnFormat()
    {
        return [
            'return_format' => $this->returnFormat,
        ];
    }
}
