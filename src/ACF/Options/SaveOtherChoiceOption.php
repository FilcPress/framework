<?php

namespace FilcPress\ACF\Options;

trait SaveOtherChoiceOption
{
    protected $saveOtherChoice = 0;

    public function saveOtherChoice($saveOtherChoice = 1)
    {
        $this->saveOtherChoice = $saveOtherChoice;

        return $this;
    }

    protected function getSaveOtherChoice()
    {
        return [
            'save_other_choice' => $this->saveOtherChoice,
        ];
    }
}
