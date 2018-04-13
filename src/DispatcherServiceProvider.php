<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-13
 * Time: 下午4:24
 */

namespace Dezsidog;


use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Contracts\ControllerDispatcher as ControllerDispatcherContract;

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
        $this->app->singleton(ControllerDispatcherContract::class, function ($app) {
            return new ControllerDispatcher($app);
        });
    }
}