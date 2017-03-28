<?php

namespace FilcPress\Foundation\Testing;

use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

abstract class TestCase extends BaseTestCase
{
    /**
     * List of plugins that the test depends on. All plugins
     * will be activated during the setUp and deactivated
     * during the tearDown processes.
     *
     * @var array
     */
    protected $plugins = [];

    /**
     * Call the given URI and return the Response.
     *
     * @param  string  $method
     * @param  string  $uri
     * @param  array  $parameters
     * @param  array  $cookies
     * @param  array  $files
     * @param  array  $server
     * @param  string  $content
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function call($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        $preserveServerVariables = $_SERVER;

        $kernel = $this->app->make(HttpKernel::class);

        $files = array_merge($files, $this->extractFilesFromDataArray($parameters));

        $symfonyRequest = SymfonyRequest::create(
            $this->prepareUrlForRequest($uri), $method, $parameters,
            $cookies, $files, array_replace($this->serverVariables, $server), $content
        );
        $symfonyRequest->overrideGlobals();
        $_SERVER['REQUEST_URI'] .= substr($_SERVER['REQUEST_URI'], -1) === '/' ? '' : '/';
        $_SERVER['PHP_SELF'] = preg_replace('/(\?.*)?$/', '', $_SERVER['REQUEST_URI']);

        $response = $kernel->handle(
            $request = Request::createFromBase($symfonyRequest)
        );

        $kernel->terminate($request, $response);

        $testResponse = $this->createTestResponse($response);

        $_SERVER = $preserveServerVariables;

        return $testResponse;
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->activatePlugins();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown()
    {
        parent::setUp();

        $this->deactivatePlugins();
    }

    /**
     * Activate plugins.
     *
     * @return void
     */
    protected function activatePlugins()
    {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');

        foreach ($this->plugins as $plugin) {
            activate_plugin($plugin);
        }
    }

    /**
     * Deactivate plugins.
     *
     * @return void
     */
    protected function deactivatePlugins()
    {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');

        deactivate_plugins($this->plugins);
    }
}
