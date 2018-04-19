<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-19
 * Time: 下午4:37
 */
declare(strict_types=1);

namespace Dezsidog\Http\Middleware;


use Closure;
use Dezsidog\Routing\Router;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;

class RequestParse
{
    protected $middlewares;

    protected $app;
    /**
     * @var Router
     */
    protected $router;

    public function __construct(Application $app, Router $router)
    {
        $this->app = $app;
        $this->router = $router;
    }

    public function handle($request, Closure $next)
    {
        return $this->sendRequestThroughRouter($request);
    }

    public function setMiddlewares($middlewares)
    {
        $this->middlewares = $middlewares;
    }

    private function sendRequestThroughRouter($request)
    {
        $this->app->instance('request', $request);

        return (new Pipeline($this->app))->send($request)->through($this->middlewares)->then(function ($request) {
            /**
             * @var Request $request
             */
            return $this->router->dispatchByVersion($request, $request->header('version', 'v1'));
        });
    }
}