<?php

namespace FilcPress\ACF\Options;

trait EndpointOption
{
    protected $endpoint = 0;

    public function endpoint($endpoint = 1)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    protected function getEndpoint()
    {
        return [
            'endpoint' => $this->endpoint,
        ];
    }
}
