<?php

namespace FilcPress\Foundation\Http;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Facade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Kernel as LaravelKernel;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Illuminate\Foundation\Http\Events\RequestHandled;

class Kernel extends LaravelKernel
{
    /**
     * Create a new HTTP kernel instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming HTTP request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle($request)
    {
        try {
            $request->enableHttpMethodParameterOverride();

            $response = $this->sendRequestThroughTemplatesManager($request);
        } catch (Exception $e) {
            $this->reportException($e);

            $response = $this->renderException($request, $e);
        } catch (Throwable $e) {
            $this->reportException($e = new FatalThrowableError($e));

            $response = $this->renderException($request, $e);
        }

        event(new RequestHandled($request, $response));

        return $response;
    }

    /**
     * Send the given request through the middleware / router.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendRequestThroughTemplatesManager($request)
    {
        $this->app->instance('request', $request);

        Facade::clearResolvedInstance('request');

        $this->bootstrap();
    }

    /**
     * Get middleware.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }
}
