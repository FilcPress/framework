<?php

use FilcPress\Models\CurrentPost;
use FilcPress\Support\Facades\Template;

Template::register('acf_testing', 'ACF testing template', function (CurrentPost $post) {
    return view('acf_testing', compact('post'));
});
