<?php

namespace FilcPress\ACF\Options;

trait PreviewSizeOption
{
    protected $previewSize = 'thumbnail';

    public function returnPreviewSize($previewSize)
    {
        $this->previewSize = $previewSize;

        return $this;
    }

    protected function getPreviewSize()
    {
        return [
            'preview_size' => $this->previewSize,
        ];
    }
}
