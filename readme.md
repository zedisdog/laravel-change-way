# laravel-change-way

[![License](http://www.wtfpl.net/wp-content/uploads/2012/12/wtfpl-badge-1.png)](LICENSE)

change the dispatched controller by header.

> bad english

> will be tested soon.

## feature

Rewrite Laravel controller dispatcher, so as to change action according to the `version` field in header.

## install
```bash
composer require dezsidog/laravel-change-way
```
**modify the base class in `app/Http/Kernel.php` from `Illuminate\Foundation\Http\Kernel` to `Dezsidog\Http\Kernel`**

## usage

write route entity
```php
Route::get('test', "V1Controller@test");

Route::group(['version' => 'v2'], function(){
    Route::get('test', "V2Controller@test");
    Route::get('test2', "V2Controller@test2");
    Route::get('test3', "V1Controller@test");
});
```
create controller `App\Http\Controllers\V1Controller`.
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class V1Controller extends Controller
{
    public function test()
    {
        return 'v1';
    }
}
```
create controller `App\Http\Controllers\V2Controller`.
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class V2Controller extends Controller
{
    public function test()
    {
        return 'v2';
    }

    public function test2()
    {
        return 'v2';
    }
}
```

this package will according to the `version` field in header to determine use which `test` method.

```php
public function testVersion()
    {
        $response = $this->getJson('api/test');
        
        $this->assertEquals('v1', $response->content());
        
        $response = $this->getJson('api/test',['version' => 'v2']);
        $this->assertEquals('v2', $response->content());

        $response = $this->getJson('api/test2', ['version' => 'v2']);
        $this->assertEquals('v2', $response->content());

        $response = $this->getJson('api/test2');
        $response->assertStatus(404);

        $response = $this->getJson('api/test3',['version' => 'v2']);
        $this->assertEquals('v1', $response->content());
    }
```
