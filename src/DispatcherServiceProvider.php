<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-13
 * Time: 下午4:24
 */
declare(strict_types=1);

namespace Dezsidog;


use Dezsidog\Routing\Router;
use Illuminate\Support\ServiceProvider;

class DispatcherServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('router', function ($app) {
            return new Router($app['events'], $app);
        });
    }
}