<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-19
 * Time: 下午2:46
 */
declare(strict_types=1);

class RouterTest extends \PHPUnit\Framework\TestCase
{
    public function testDispatch()
    {
        $router = new \Dezsidog\Routing\Router(new \Illuminate\Events\Dispatcher());
        $router->setRoutes(new \Dezsidog\Routing\RouteCollection());
        $router->get('/', function(){
            return 'v1';
        });
        $router->group(['version' => 'v2'],function(\Dezsidog\Routing\Router $router){
            $router->get('/', function(){
                return 'v2';
            });
        });

        $request = new \Illuminate\Http\Request();

        $response = $router->dispatchByVersion($request, 'v1');

        $this->assertEquals('v1', $response->content());

        $response = $router->dispatchByVersion($request,'v2');
        $this->assertEquals('v2', $response->content());
    }
}