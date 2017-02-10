<?php

namespace FilcPress\Middlewaring;

use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class MiddlewaringServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param \Illuminate\Contracts\Http\Kernel $kernel
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function boot(Kernel $kernel, Request $request)
    {
        if ($this->isCli()) {
            return;
        }

        $response = (new Pipeline($kernel->getApplication()))
            ->send($request)
            ->through($kernel->getApplication()->shouldSkipMiddleware() ? [] : $kernel->getMiddleware())
            ->then(function () {});

        if ($response instanceof \Illuminate\Http\Response) {
            $response->send();
        }
    }

    private function isCli()
    {
        return php_sapi_name() === 'cli';
    }
}
