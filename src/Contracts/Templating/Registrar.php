<?php

namespace FilcPress\Contracts\Templating;

interface Registrar
{
    /**
     * Register a new template with the templates manager.
     *
     * @param  string  $slug
     * @param  string  $title
     * @param  \Closure|array|string  $action
     * @return void
     */
    public function register($slug, $title, $action);
}
