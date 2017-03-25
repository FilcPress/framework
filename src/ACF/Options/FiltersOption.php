<?php

namespace FilcPress\ACF\Options;

trait FiltersOption
{
    protected $filters = ['search', 'post_type', 'taxonomy'];

    public function filters($filters)
    {
        $this->filters = $filters;

        return $this;
    }

    public function clearDefaultFilters()
    {
        $this->filters = [];

        return $this;
    }

    public function addFilter($filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    protected function getFilters()
    {
        return [
            'filters' => $this->filters,
        ];
    }
}
