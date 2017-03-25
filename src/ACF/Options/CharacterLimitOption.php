<?php

namespace FilcPress\ACF\Options;

trait CharacterLimitOption
{
    protected $characterLimit = '';

    public function characterLimit($characterLimit)
    {
        $this->characterLimit = $characterLimit;

        return $this;
    }

    protected function getCharacterLimit()
    {
        return [
            'character_limit' => $this->characterLimit,
        ];
    }
}
