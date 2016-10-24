<?php

namespace FilcPress\Templating;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Container\Container;
use Illuminate\Support\Traits\Macroable;
use FilcPress\Contracts\Templating\Registrar as RegistrarContract;

class TemplatesManager implements RegistrarContract
{
    use Macroable;

    /**
     * The temaplate collection instance.
     *
     * @var \FilcPress\Templating\TemplateCollection
     */
    protected $template;

    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     * The currently dispatched template instance.
     *
     * @var \FilcPress\Templating\Template
     */
    protected $current;

    /**
     * The template group attribute stack.
     *
     * @var array
     */
    protected $groupStack = [];

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->templates = new TemplateCollection;
    }

    public function render($templateSlug = null)
    {
        $response = $this->dispatchToTemplate($templateSlug, $this->container->make('request'));

        $response->send();
    }

    public function register($slug, $title, $action)
    {
        return $this->addTemplate($slug, $title, $action);
    }

    protected function addTemplate($slug, $title, $action)
    {
        return $this->templates->add($this->createTemplate($slug, $title, $action));
    }

    /**
     * Create a new template instance.
     */
    protected function createTemplate($slug, $title, $action)
    {
        // If the route is routing to a controller we will parse the route action into
        // an acceptable array format before registering it and creating this route
        // instance itself. We need to build the Closure that will call this out.
        if ($this->actionReferencesController($action)) {
            $action = $this->convertToControllerAction($action);
        }

        $template = $this->newTemplate(
            $slug, $title, $action
        );

        return $template;
    }

    /**
     * Determine if the action is pointing to a controller.
     *
     * @param  array  $action
     * @return bool
     */
    protected function actionReferencesController($action)
    {
        if ($action instanceof Closure) {
            return false;
        }

        return is_string($action) || (isset($action['uses']) && is_string($action['uses']));
    }

    /**
     * Add a controller based route action to the action array.
     *
     * @param  array|string  $action
     * @return array
     */
    protected function convertToControllerAction($action)
    {
        if (is_string($action)) {
            $action = ['uses' => $action];
        }

        // Here we'll merge any group "uses" statement if necessary so that the action
        // has the proper clause for this property. Then we can simply set the name
        // of the controller on the action and return the action array for usage.
        if (! empty($this->groupStack)) {
            $action['uses'] = $this->prependGroupUses($action['uses']);
        }

        // Here we will set this controller name on the action array just so we always
        // have a copy of it for reference if we need it. This can be used while we
        // search for a controller name or do some other type of fetch operation.
        $action['controller'] = $action['uses'];

        return $action;
    }

    /**
     * Create a template group with shared attributes.
     *
     * @param  array  $attributes
     * @param  \Closure  $callback
     * @return void
     */
    public function group(array $attributes, Closure $callback)
    {
        $this->updateGroupStack($attributes);

        // Once we have updated the group stack, we will execute the user Closure and
        // merge in the groups attributes when the route is created. After we have
        // run the callback, we will pop the attributes off of this group stack.
        call_user_func($callback, $this);

        array_pop($this->groupStack);
    }

    /**
     * Update the group stack with the given attributes.
     *
     * @param  array  $attributes
     * @return void
     */
    protected function updateGroupStack(array $attributes)
    {
        if (! empty($this->groupStack)) {
            $attributes = $this->mergeGroup($attributes, end($this->groupStack));
        }

        $this->groupStack[] = $attributes;
    }

    /**
     * Merge the given array with the last group stack.
     *
     * @param  array  $new
     * @return array
     */
    public function mergeWithLastGroup($new)
    {
        return $this->mergeGroup($new, end($this->groupStack));
    }

    /**
     * Merge the given group attributes.
     *
     * @param  array  $new
     * @param  array  $old
     * @return array
     */
    public static function mergeGroup($new, $old)
    {
        $new['namespace'] = static::formatUsesPrefix($new, $old);

        $new['prefix'] = static::formatGroupPrefix($new, $old);

        if (isset($new['domain'])) {
            unset($old['domain']);
        }

        $new['where'] = array_merge(
            isset($old['where']) ? $old['where'] : [],
            isset($new['where']) ? $new['where'] : []
        );

        if (isset($old['as'])) {
            $new['as'] = $old['as'].(isset($new['as']) ? $new['as'] : '');
        }

        return array_merge_recursive(Arr::except($old, ['namespace', 'prefix', 'where', 'as']), $new);
    }

    /**
     * Prepend the last group uses onto the use clause.
     *
     * @param  string  $uses
     * @return string
     */
    protected function prependGroupUses($uses)
    {
        $group = end($this->groupStack);

        return isset($group['namespace']) && strpos($uses, '\\') !== 0 ? $group['namespace'].'\\'.$uses : $uses;
    }
    /**
     * Dispatch the request to a route and return the response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function dispatchToTemplate($templateSlug, $request)
    {
        $template = null;

        if (! is_null($templateSlug)) {
            $template = $this->findTemplateBySlug($templateSlug);
        }

        if (is_null($template)) {
            $template = $this->findTemplate();
        }

        return $this->runTemplateWithinStack($template, $request);
    }

    /**
     * Run the given route within a Stack "onion" instance.
     *
     * @param  \FilcPress\Templating\Template  $template
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function runTemplateWithinStack(Template $template, Request $request)
    {
        $callback = function ($request) use ($template) {
            return $this->prepareResponse(
                $request, $template->run()
            );
        };

        return $callback($request);
    }

    /**
     * Create a new Template object.
     */
    protected function newTemplate($slug, $title, $action)
    {
        return (new Template($slug, $title, $action))
            ->setTemplatesManager($this)
            ->setContainer($this->container);
    }

    public function getTemplatesForAdminPanel()
    {
        return $this->templates->getTemplatesForAdminPanel();
    }

    /**
     * Find the template matching a slug.
     */
    protected function findTemplateBySlug($slug)
    {
        $this->current = $template = $this->templates->findTemplateBySlug($slug);

        $this->container->instance(Template::class, $template);

        return $template;
    }

    /**
     * Find the route matching a given request.
     *
     * @return \FilcPress\Templating\Template
     */
    protected function findTemplate()
    {
        $this->current = $template = $this->templates->match();

        $this->container->instance(Template::class, $template);

        return $template;
    }

    public function getTemplates() {
        return $this->templates;
    }

    /**
     * Create a response instance from the given value.
     *
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     * @param  mixed  $response
     * @return \Illuminate\Http\Response
     */
    public function prepareResponse($request, $response)
    {
        if ($response instanceof PsrResponseInterface) {
            $response = (new HttpFoundationFactory)->createResponse($response);
        } elseif (! $response instanceof SymfonyResponse) {
            $response = new Response($response);
        }

        return $response->prepare($request);
    }
}

