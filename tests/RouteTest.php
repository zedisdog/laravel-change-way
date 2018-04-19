<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-19
 * Time: 下午2:43
 */

class RouteTest extends \PHPUnit\Framework\TestCase
{
    public function testSetVersion()
    {
        $route = new \Dezsidog\Routing\Route('GET', '/', [
            'version' => 'v1'
        ]);
        $route2 = new \Dezsidog\Routing\Route('GET', '/',[]);

        $this->assertEquals('v1', $route->getVersion());
        $this->assertEquals('v1', $route2->getVersion());
    }
}