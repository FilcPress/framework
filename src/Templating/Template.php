<?php

namespace FilcPress\Templating;

use Closure;
use LogicException;
use ReflectionMethod;
use ReflectionFunction;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use UnexpectedValueException;
use Illuminate\Container\Container;

class Template
{
    use TemplateDependencyResolverTrait;
    /**
     * The template action array.
     *
     * @var array
     */
    protected $action;

    /**
     * The controller instance.
     *
     * @var mixed
     */
    protected $controller;

    /**
     * The default values for the template.
     *
     * @var array
     */
    protected $defaults = [];

    /**
     * The array of matched parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * The parameter names for the template.
     *
     * @var array|null
     */
    protected $parameterNames;

    /**
     * The templates manager instance used by the template.
     *
     * @var \FilcPress\Templating\TemplatesManager
     */
    protected $templatesManager;

    /**
     * The container instance used by the template.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     *
     */
    protected $slug;

    /**
     *
     */
    protected $title;

    /**
     * Create a new Template instance.
     *
     * @param  array|string  $methods
     * @param  string  $uri
     * @param  \Closure|array  $action
     * @return void
     */
    public function __construct($slug, $title, $action)
    {
        $this->slug = $slug;
        $this->title = $title;
        $this->action = $this->parseAction($action);
    }

    /**
     * Parse the route action into a standard array.
     *
     * @param  callable|array|null  $action
     * @return array
     *
     * @throws \UnexpectedValueException
     */
    protected function parseAction($action)
    {
        // If no action is passed in right away, we assume the user will make use of
        // fluent routing. In that case, we set a default closure, to be executed
        // if the user never explicitly sets an action to handle the given uri.
        if (is_null($action)) {
            return ['uses' => function () {
                throw new LogicException("Route for [{$this->uri}] has no action.");
            }];
        }

        // If the action is already a Closure instance, we will just set that instance
        // as the "uses" property, because there is nothing else we need to do when
        // it is available. Otherwise we will need to find it in the action list.
        if (is_callable($action)) {
            return ['uses' => $action];
        }

        // If no "uses" property has been set, we will dig through the array to find a
        // Closure instance within this list. We will set the first Closure we come
        // across into the "uses" property that will get fired off by this route.
        elseif (! isset($action['uses'])) {
            $action['uses'] = $this->findCallable($action);
        }

        if (is_string($action['uses']) && ! Str::contains($action['uses'], '@')) {
            $action['uses'] = $this->makeInvokableAction($action['uses']);
        }

        return $action;
    }

    /**
     * Find the callable in an action array.
     *
     * @param  array  $action
     * @return callable
     */
    protected function findCallable(array $action)
    {
        return Arr::first($action, function ($value, $key) {
            return is_callable($value) && is_numeric($key);
        });
    }

    /**
     * Make an action for an invokable controller.
     *
     * @param  string $action
     * @return string
     */
    protected function makeInvokableAction($action)
    {
        if (! method_exists($action, '__invoke')) {
            throw new UnexpectedValueException(sprintf(
                'Invalid route action: [%s]', $action
            ));
        }

        return $action.'@__invoke';
    }

    /**
     * Run the route action and return the response.
     */
    public function run()
    {
        $this->container = $this->container ?: new Container;

        if ($this->isControllerAction()) {
            return $this->runController();
        }

        return $this->runCallable();
    }

    /**
     * Checks whether the route's action is a controller.
     *
     * @return bool
     */
    protected function isControllerAction()
    {
        return is_string($this->action['uses']);
    }

    /**
     * Run the route action and return the response.
     *
     * @return mixed
     */
    protected function runCallable()
    {
        $parameters = $this->resolveMethodDependencies(
            [], new ReflectionFunction($this->action['uses'])
        );

        $callable = $this->action['uses'];

        return $callable(...array_values($parameters));
    }

    /**
     * Run the route action and return the response.
     *
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function runController()
    {
        return (new ControllerDispatcher($this->container))->dispatch(
            $this, $this->getController(), $this->getControllerMethod()
        );
    }

    /**
     * Get the controller instance for the route.
     *
     * @return mixed
     */
    public function getController()
    {
        list($class) = explode('@', $this->action['uses']);

        if (! $this->controller) {
            $this->controller = $this->container->make($class);
        }

        return $this->controller;
    }

    /**
     * Get the controller method used for the route.
     *
     * @return string
     */
    protected function getControllerMethod()
    {
        return explode('@', $this->action['uses'])[1];
    }

    /**
     * Get the name of the route instance.
     *
     * @return string
     */
    public function getName()
    {
        return isset($this->action['as']) ? $this->action['as'] : null;
    }

    /**
     * Add or change the route name.
     *
     * @param  string  $name
     * @return $this
     */
    public function name($name)
    {
        $this->action['as'] = isset($this->action['as']) ? $this->action['as'].$name : $name;

        return $this;
    }

    /**
     * Set the handler for the route.
     *
     * @param  \Closure|string  $action
     * @return $this
     */
    public function uses($action)
    {
        return $this->setAction(array_merge($this->action, $this->parseAction([
            'uses' => $action,
            'controller' => $action,
        ])));
    }

    /**
     * Get the action name for the route.
     *
     * @return string
     */
    public function getActionName()
    {
        return isset($this->action['controller']) ? $this->action['controller'] : 'Closure';
    }

    /**
     * Get the action array for the template.
     *
     * @return array
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Get the slug for the template.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the title for the template.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the action array for the route.
     *
     * @param  array  $action
     * @return $this
     */
    public function setAction(array $action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Set the templates manager instance on the template.
     *
     * @param  \FilcPress\Templating\TemplatesManager  $templatesManager
     * @return $this
     */
    public function setTemplatesManager(TemplatesManager $templatesManager)
    {
        $this->templatesManager = $templatesManager;

        return $this;
    }

    /**
     * Set the container instance on the template.
     *
     * @param  \Illuminate\Container\Container  $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }
}
