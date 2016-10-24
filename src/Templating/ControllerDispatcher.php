<?php

namespace FilcPress\Templating;

use Illuminate\Container\Container;

class ControllerDispatcher
{
    use TemplateDependencyResolverTrait;

    /**
     * The container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     * Create a new controller dispatcher instance.
     *
     * @param  \Illuminate\Container\Container  $container
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Dispatch a request to a given controller and method.
     *
     * @param  \FilcPress\Templating\Template  $template
     * @param  mixed  $controller
     * @param  string  $method
     * @return mixed
     */
    public function dispatch(Template $template, $controller, $method)
    {
        $parameters = $this->resolveClassMethodDependencies(
            [], $controller, $method
        );

        if (method_exists($controller, 'callAction')) {
            return $controller->callAction($method, $parameters);
        }

        return call_user_func_array([$controller, $method], $parameters);
    }
}
