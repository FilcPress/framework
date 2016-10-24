<?php

namespace FilcPress\Templating;

use Countable;
use ArrayIterator;
use IteratorAggregate;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TemplateCollection implements Countable, IteratorAggregate
{
    /**
     * An array of the templates keyed by method.
     *
     * @var array
     */
    protected $templates = [];

    /**
     * An flattened array of all of the templates.
     *
     * @var array
     */
    protected $allTemplates = [];

    /**
     * A look-up table of templates by their names.
     *
     * @var array
     */
    protected $nameList = [];

    /**
     * A look-up table of templates by controller action.
     *
     * @var array
     */
    protected $actionList = [];

    /**
     * Add a Template instance to the collection.
     *
     * @param  \FilcPress\Templating\Template  $template
     * @return \FilcPress\Templating\Template
     */
    public function add(Template $template)
    {
        $this->addToCollections($template);

        $this->addLookups($template);

        return $template;
    }

    /**
     * Add the given template to the arrays of templates.
     *
     * @param  \FilcPress\Templating\Template  $template
     * @return void
     */
    protected function addToCollections($template)
    {
        $this->templates[$template->getSlug()] = $template;

        $this->allTemplates[] = $template;
    }

    /**
     * Add the template to any look-up tables if necessary.
     *
     * @param  \FilcPress\Templating\Template  $template
     * @return void
     */
    protected function addLookups($template)
    {
        // If the route has a name, we will add it to the name look-up table so that we
        // will quickly be able to find any template associate with a name and not have
        // to iterate through every template every time we need to perform a look-up.
        $action = $template->getAction();

        if (isset($action['as'])) {
            $this->nameList[$action['as']] = $template;
        }

        // When the template is pointing to a controller we will also store the action that
        // is used by the template. This will let us reversly find a link to controllers while
        // processing a request and easily generate URLs to the given controllers.
        if (isset($action['controller'])) {
            $this->addToActionList($action, $template);
        }
    }

    /**
     * Refresh the name look-up table.
     *
     * This is done in case any names are fluently defined.
     *
     * @return void
     */
    public function refreshNameLookups()
    {
        $this->nameList = [];

        foreach ($this->allTemplates as $template) {
            if ($template->getName()) {
                $this->nameList[$template->getName()] = $template;
            }
        }
    }

    /**
     * Add a template to the controller action dictionary.
     *
     * @param  array  $action
     * @param  \FilcPress\Templating\Template  $template
     * @return void
     */
    protected function addToActionList($action, $template)
    {
        $this->actionList[trim($action['controller'], '\\')] = $template;
    }

    /**
     * Find the first template matching a given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \FilcPress\Templating\Template
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
//    public function match(Request $request)
//    {
//        $routes = $this->get($request->getMethod());
//
//        // First, we will see if we can find a matching route for this current request
//        // method. If we can, great, we can just return it so that it can be called
//        // by the consumer. Otherwise we will check for routes with another verb.
//        $route = $this->check($routes, $request);
//
//        if (! is_null($route)) {
//            return $route->bind($request);
//        }
//
//        // If no route was found we will now check if a matching route is specified by
//        // another HTTP verb. If it is we will need to throw a MethodNotAllowed and
//        // inform the user agent of which HTTP verb it should use for this route.
//        $others = $this->checkForAlternateVerbs($request);
//
//        if (count($others) > 0) {
//            return $this->getRouteForMethods($request, $others);
//        }
//
//        throw new NotFoundHttpException;
//    }

    /**
     * Determine if any templates match on another HTTP verb.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
//    protected function checkForAlternateVerbs($request)
//    {
//        $methods = array_diff(Router::$verbs, [$request->getMethod()]);
//
//        // Here we will spin through all verbs except for the current request verb and
//        // check to see if any routes respond to them. If they do, we will return a
//        // proper error response with the correct headers on the response string.
//        $others = [];
//
//        foreach ($methods as $method) {
//            if (! is_null($this->check($this->get($method), $request, false))) {
//                $others[] = $method;
//            }
//        }
//
//        return $others;
//    }

    /**
     * Get a route (if necessary) that responds when other available methods are present.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $methods
     * @return \FilcPress\Templating\Template
     *
     * @throws \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     */
//    protected function getRouteForMethods($request, array $methods)
//    {
//        if ($request->method() == 'OPTIONS') {
//            return (new Route('OPTIONS', $request->path(), function () use ($methods) {
//                return new Response('', 200, ['Allow' => implode(',', $methods)]);
//            }))->bind($request);
//        }
//
//        $this->methodNotAllowed($methods);
//    }

    /**
     * Throw a method not allowed HTTP exception.
     *
     * @param  array  $others
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     */
//    protected function methodNotAllowed(array $others)
//    {
//        throw new MethodNotAllowedHttpException($others);
//    }

    /**
     * Determine if a route in the array matches the request.
     *
     * @param  array  $routes
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $includingMethod
     * @return \FilcPress\Templating\Template|null
     */
//    protected function check(array $routes, $request, $includingMethod = true)
//    {
//        return Arr::first($routes, function ($value) use ($request, $includingMethod) {
//            return $value->matches($request, $includingMethod);
//        });
//    }

    /**
     * Get all of the templates in the collection.
     *
     * @param  string|null  $method
     * @return array
     */
    public function get($method = null)
    {
        if (is_null($method)) {
            return $this->getTemplates();
        }

        return Arr::get($this->templates, $method, []);
    }

    /**
     * Determine if the template collection contains a given named template.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasNamedTemplate($name)
    {
        return ! is_null($this->getByName($name));
    }

    /**
     * Get a template instance by its name.
     *
     * @param  string  $name
     * @return \FilcPress\Templating\Template|null
     */
    public function getByName($name)
    {
        return isset($this->nameList[$name]) ? $this->nameList[$name] : null;
    }

    /**
     * Get a template instance by its controller action.
     *
     * @param  string  $action
     * @return \FilcPress\Templating\Template|null
     */
    public function getByAction($action)
    {
        return isset($this->actionList[$action]) ? $this->actionList[$action] : null;
    }

    /**
     * Get all of the templates in the collection.
     *
     * @return array
     */
    public function getTemplates()
    {
        return $this->allTemplates;
    }

    /**
     * Get all of the templates keyed by their HTTP verb / method.
     *
     * @return array
     */
    public function getTemplatesByMethod()
    {
        return $this->templates;
    }

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->getTemplates());
    }

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count()
    {
        return count($this->getTemplates());
    }

    /**
     * Find the current template.
     */
    public function match()
    {
        $post = get_post(get_the_ID());

        if (! $post instanceof \WP_Post) {
            throw new \Exception('Template not found.');
        }

        if ($post->post_type == 'page') {
            $templateSlug = get_post_meta(get_the_ID(), '_wp_page_template', true);
        } else {
            throw new \Exception('Templates for post types other then pages are not supported yet.');
        }

        return $this->findTemplateBySlug($templateSlug);
    }

    public function findTemplateBySlug($slug)
    {
        return isset($this->templates[$slug]) ? $this->templates[$slug] : null;
    }
}
