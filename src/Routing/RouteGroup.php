<?php
/**
 * Created by PhpStorm.
 * User: zed
 * Date: 18-4-19
 * Time: 下午3:42
 */
declare(strict_types=1);

namespace Dezsidog\Routing;


use Illuminate\Routing\RouteGroup as LaravelRouteGroup;
use Illuminate\Support\Arr;

class RouteGroup extends LaravelRouteGroup
{
    public static function merge($new, $old)
    {
        if (isset($new['domain'])) {
            unset($old['domain']);
        }

        $new = array_merge(static::formatAs($new, $old), [
            'namespace' => static::formatNamespace($new, $old),
            'prefix' => static::formatPrefix($new, $old),
            'where' => static::formatWhere($new, $old),
            'version' => static::formatVersion($new, $old),
        ]);

        return array_merge_recursive(Arr::except(
            $old, ['namespace', 'prefix', 'where', 'as']
        ), $new);
    }

    public static function formatVersion($new, $old)
    {
        return $old['version'];
    }
}