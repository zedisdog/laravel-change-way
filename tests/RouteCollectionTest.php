<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-19
 * Time: 下午2:47
 */

class RouteCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testAddRoute()
    {
        $collect = new \Dezsidog\Routing\RouteCollection();

        $collect->add(new \Dezsidog\Routing\Route('GET', '/', ['version' => 'v1']));

        $this->assertInstanceOf(\Illuminate\Routing\RouteCollection::class, $collect->version('v1'));
    }
}