<?php

namespace FilcPress\ACF\Options;

trait NewLinesOption
{
    protected $newLines = '';

    public function newLines($newLines)
    {
        $this->newLines = $newLines;

        return $this;
    }

    public function newLinesWithParagraphs()
    {
        $this->newLines = 'wpautop';

        return $this;
    }

    public function newLinesWithBrTags()
    {
        $this->newLines = 'br';

        return $this;
    }

    protected function getNewLines()
    {
        return [
            'newLines' => $this->newLines,
        ];
    }
}
