<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-13
 * Time: 下午4:21
 */

namespace Dezsidog;


use Illuminate\Routing\ControllerDispatcher as BaseControllerDispatcher;
use Illuminate\Routing\Route;

class ControllerDispatcher extends BaseControllerDispatcher
{
    public function dispatch(Route $route, $controller, $method)
    {
        $request = $this->container->make('request');
        $version = $request->header('version');
        if ($version && $version !== 'v1') {
            $class = get_class($controller);
            $class_path = explode('\\', $class);
            array_splice($class_path, -1, 0, $version);
            $controller = $this->container->make(implode('\\', $class_path));
        }
        return parent::dispatch($route, $controller, $method);
    }
}