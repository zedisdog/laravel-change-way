<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-19
 * Time: 上午11:23
 */
declare(strict_types=1);

namespace Dezsidog\Routing;


use Illuminate\Routing\Route as LaravelRoute;

class Route extends LaravelRoute
{
    /**
     * set the version property
     * @param null|string $version
     * @return Route
     */
    public function setVersion(?string $version): self
    {
        $version ? $this->action['version'] = $version : $this->action['version'] = 'v1';

        return $this;
    }

    /**
     * get the version property
     * @return null|string
     */
    public function getVersion(): ?string
    {
        $this->action['version'] = $this->action['version'] ?? 'v1';
        return $this->action['version'];
    }
}