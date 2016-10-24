<?php

namespace FilcPress\Templating;

use Illuminate\Support\ServiceProvider;

class TemplatingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTemplates();

        $this->hookTemplate();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerTemplatesManager();
    }

    /**
     * Register the templates manager instance.
     *
     * @return void
     */
    protected function registerTemplatesManager()
    {
        $this->app['template'] = $this->app->share(function ($app) {
            return new TemplatesManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['template'];
    }

    private function registerTemplates()
    {
        // Load all registered templates, so they display in admin
        add_filter('theme_page_templates', [$this, 'getTemplates'], 99);
    }

    public function getTemplates()
    {
        $result = [];

        foreach (app('template')->getTemplates() as $template) {
            $result[$template->getSlug()] = $template->getTitle();
        }

        return $result;
    }

    private function hookTemplate()
    {
//        add_filter('template_include', [$this, 'loadTemplate'], 99);
    }

//    private function loadTemplate()
//    {
//        $template = '';
//
//        $post = get_post(get_the_ID());
//
//        die('loadTemplate');
//        if (! $post instanceof \WP_Post) {
//            throw new \Exception('$post is not an instance of WP_Post');
//        }
//
//        if ($post->post_type == 'page') {
//            $template = get_post_meta(get_the_ID(), '_wp_page_template', true);
//        } else {
//            $template = get_post_meta(get_the_ID(), 'cpt_template', true);
//        }
//
//        if (isset($this->templates[$template])) {
//            $this->currentTemplateHandler = $this->templates[$template]['handler'];
//        } else {
//            $this->isPage = false;
//        }
//
//        return get_template_directory() . '/index.php';
//
}
