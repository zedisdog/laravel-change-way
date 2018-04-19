<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-19
 * Time: 上午11:33
 */
declare(strict_types=1);

namespace Dezsidog\Routing;


use Illuminate\Routing\RouteCollection as LaravelRouteCollection;

class RouteCollection extends LaravelRouteCollection
{
    /**
     * @var RouteCollection[]
     */
    protected $versions = [];

    /**
     * @param Route $route
     */
    public function addLookups($route)
    {
        parent::addLookups($route);
        $this->createVersion($route->getVersion());
        $this->versions[$route->getVersion()]->add($route);
    }

    public function version(string $version): \Illuminate\Routing\RouteCollection
    {
        return $this->versions[$version] ?? null;
    }

    public function createVersion($version)
    {
        if (!isset($this->versions[$version])) {
            $this->versions[$version] = new \Illuminate\Routing\RouteCollection();
        }
    }
}