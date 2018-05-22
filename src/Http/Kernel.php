<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-19
 * Time: 下午5:14
 */

namespace Dezsidog\Http;


use Dezsidog\Routing\Router;
use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;
use Illuminate\Http\Request;

class Kernel extends LaravelHttpKernel
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * Get the route dispatcher callback.
     *
     * @return \Closure
     */
    protected function dispatchToRouter()
    {
        return function ($request) {
            /**
             * @var Request $request
             */
            $this->app->instance('request', $request);

            $oldRouter = $this->router;

            $this->router = $this->app->make('router');

            foreach ($oldRouter->getMiddlewareGroups() as $key => $value) {
                $this->router->middlewareGroup($key, $value);
            }

            foreach ($oldRouter->getMiddleware() as $key => $value) {
                $this->router->aliasMiddleware($key, $value);
            }

            return $this->router->dispatchByVersion($request, $request->header('version', 'v1'));
        };
    }
}