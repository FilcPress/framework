<?php

namespace FilcPress\ACF\Options;

trait LibraryOption
{
    protected $library = 'all';

    public function library($library)
    {
        $this->library = $library;

        return $this;
    }

    public function libraryLimitUploadedToModel()
    {
        $this->library = 'uploadedTo';

        return $this;
    }

    protected function getLibrary()
    {
        return [
            'library' => $this->library,
        ];
    }
}
