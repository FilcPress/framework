<?php

namespace FilcPress\ACF\Options;

trait TaxonomyOption
{
    protected $taxonomy = [];

    public function taxonomy($taxonomies)
    {
        $this->taxonomy = $taxonomies;

        return $this;
    }

    public function addTaxonomy($taxonomy)
    {
        $this->taxonomy[] = $taxonomy;

        return $this;
    }

    protected function getTaxonomy()
    {
        return [
            'taxonomy' => $this->taxonomy,
        ];
    }
}
