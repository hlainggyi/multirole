# MultiRole & MultiUser for Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](license.md)


## Install

Via Composer

``` bash
$ composer require learn88/multirole
```

Next, add your `new Provider` to the providers array of `config/app.php:`

```bash
'providers' => [


  learn88\multirole\multiroleServiceProvider::class,


],
```
Next, add your `new Kernel` to the `HTTP kernel`  `$routeMiddleware`

```bash
protected $routeMiddleware = [


  'roles' => \learn88\multirole\Http\Middleware\CheckRole::class,


],  
```

### New
**Command:**
```bash
  php artisan make:multirole
```
```bash
  composer dump-autoload
```

_required : database_
```bash
  php artisan migrate
```
```bash
  php artisan db:seed
```


###### Default
> username : admin@learn88.dev

> password : password


## Usage
```php
    Route::get('users}', [
      'uses' => 'UserCtrl@index',
      'as' => 'users.show',
      'middleware'=>'roles',  // Rroute Middleware Role Check   
      'roles'=>['role_admin'] // Allow Role Name ['role_name' , 'etc..']
    ]);

```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
