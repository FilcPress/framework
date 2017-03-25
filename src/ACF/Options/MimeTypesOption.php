<?php

namespace FilcPress\ACF\Options;

trait MimeTypesOption
{
    protected $mimeTypes = '';

    public function mimeTypes($mimeTypes)
    {
        $this->mimeTypes = $mimeTypes;

        return $this;
    }

    public function mimeType($mimeType)
    {
        if (! empty($this->mimeTypes)) {
            $this->mimeTypes .= ',';
        }

        $mimeType = trim($mimeType);
        $mimeType = trim($mimeType, ',');
        $mimeType = trim($mimeType);
        $this->mimeTypes .= $mimeType;

        return $this;
    }

    protected function getMimeTypes()
    {
        return [
            'mime_types' => $this->mimeTypes,
        ];
    }
}
