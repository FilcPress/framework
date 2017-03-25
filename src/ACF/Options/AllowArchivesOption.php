<?php

namespace FilcPress\ACF\Options;

trait AllowArchivesOption
{
    protected $allowArchives = 1;

    public function allowArchives($allowArchives = 1)
    {
        $this->allowArchives = $allowArchives;

        return $this;
    }

    public function notAllowArchives()
    {
        $this->allowArchives = 0;

        return $this;
    }

    protected function getAllowArchives()
    {
        return [
            'allow_archives' => $this->allowArchives,
        ];
    }
}
