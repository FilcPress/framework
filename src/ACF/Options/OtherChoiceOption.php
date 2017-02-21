<?php

namespace FilcPress\ACF\Options;

trait OtherChoiceOption
{
    protected $otherChoice = 0;

    public function otherChoice($otherChoice = 1)
    {
        $this->otherChoice = $otherChoice;

        return $this;
    }

    protected function getOtherChoice()
    {
        return [
            'other_choice' => $this->otherChoice,
        ];
    }
}
