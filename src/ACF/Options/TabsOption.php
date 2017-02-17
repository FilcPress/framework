<?php

namespace FilcPress\ACF\Options;

trait TabsOption
{
    protected $tabs = 'all';

    public function tabs($tabs)
    {
        $this->tabs = $tabs;

        return $this;
    }

    public function tabsVisualOnly()
    {
        $this->tabs = 'visual';

        return $this;
    }

    public function tabsTextOnly()
    {
        $this->tabs = 'text';

        return $this;
    }

    protected function getTabs()
    {
        return [
            'tabs' => $this->tabs,
        ];
    }
}
