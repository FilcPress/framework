<?php

namespace FilcPress\ACF\Options;

trait LoadTermsOption
{
    protected $loadTerms = 0;

    public function loadTerms($loadTerms = 1)
    {
        $this->loadTerms = $loadTerms;

        return $this;
    }

    protected function getLoadTerms()
    {
        return [
            'load_terms' => $this->loadTerms,
        ];
    }
}
