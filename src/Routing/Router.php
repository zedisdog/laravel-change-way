<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-19
 * Time: 上午10:02
 */
declare(strict_types=1);

namespace Dezsidog\Routing;


use Illuminate\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as LaravelRouter;

class Router extends LaravelRouter
{
    /**
     * @var RouteCollection $routes
     */
    protected $routes;

    public function __construct(Dispatcher $events, Container $container = null)
    {
        parent::__construct($events, $container);
        $this->routes = new RouteCollection();
    }

    public function dispatchByVersion(Request $request, string $version)
    {
        if (! $routes = $this->routes->version($version)) {
            throw new \RuntimeException('unknown route version');
        }

        $router = clone $this;
        $router->setRoutes($routes);

        $response = $router->dispatch($request);

        unset($router);

        return $response;
    }

    /**
     * Create a new Route object.
     *
     * @param  array|string  $methods
     * @param  string  $uri
     * @param  mixed  $action
     * @return \Illuminate\Routing\Route
     */
    protected function newRoute($methods, $uri, $action)
    {
        return (new Route($methods, $uri, $action))
            ->setRouter($this)
            ->setContainer($this->container);
    }
}