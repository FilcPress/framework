<?php

namespace FilcPress\ACF\Options;

trait FirstDayOption
{
    protected $firstDay = 1;

    public function firstDay($firstDay)
    {
        $this->firstDay = $firstDay;

        return $this;
    }

    public function firstDaySunday()
    {
        $this->firstDay = 0;

        return $this;
    }

    protected function getFirstDay()
    {
        return [
            'first_day' => $this->firstDay,
        ];
    }
}
