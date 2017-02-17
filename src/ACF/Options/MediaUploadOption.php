<?php

namespace FilcPress\ACF\Options;

trait MediaUploadOption
{
    protected $mediaUpload = 1;

    public function mediaUpload($mediaUpload)
    {
        $this->mediaUpload = $mediaUpload;

        return $this;
    }

    public function mediaUploadDisabled()
    {
        $this->mediaUpload = 0;

        return $this;
    }

    protected function getMediaUpload()
    {
        return [
            'media_upload' => $this->mediaUpload,
        ];
    }
}
