<?php

namespace FilcPress\ACF\Options;

trait SaveTermsOption
{
    protected $saveTerms = 0;

    public function saveTerms($saveTerms = 1)
    {
        $this->saveTerms = $saveTerms;

        return $this;
    }

    protected function getSaveTerms()
    {
        return [
            'save_terms' => $this->saveTerms,
        ];
    }
}
