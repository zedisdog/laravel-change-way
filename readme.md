# laravel-change-way

[![License](http://www.wtfpl.net/wp-content/uploads/2012/12/wtfpl-badge-1.png)](LICENSE)

change the dispatched controller by header.

> bad english

> will be tested soon.

## feature

Rewrite Laravel controller dispatcher, so as to change namespace of route controller according to the version in header.

## install
```bash
composer require dezsidog/laravel-change-way
```

## usage

write one route entity
```php
Route::get('/test','TestController@test');
```
create controller `App\Http\Controllers\TestController`,and put a method `test`.

create controller `App\Http\Controllers\v2\TestController`, and put a method `test`.

this package will according to the `version` field in header to determine use `test` in `App\Http\Controllers\TestController` or `App\Http\Controllers\v2\TestController`
