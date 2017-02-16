<?php

namespace FilcPress\ACF\Options;

trait RowsOption
{
    protected $rows = '';

    public function rows($rows)
    {
        $this->rows = $rows;

        return $this;
    }

    protected function getRows()
    {
        return [
            'rows' => $this->rows,
        ];
    }
}
