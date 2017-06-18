# MultiRole & MultiUser for Laravel

[![Latest Stable Version](https://poser.pugx.org/learn88/multirole/v/stable)](https://packagist.org/packages/learn88/multirole)
[![Total Downloads](https://poser.pugx.org/learn88/multirole/downloads)](https://packagist.org/packages/learn88/multirole)
[![Latest Unstable Version](https://poser.pugx.org/learn88/multirole/v/unstable)](https://packagist.org/packages/learn88/multirole)
[![License](https://poser.pugx.org/learn88/multirole/license)](https://packagist.org/packages/learn88/multirole)

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
      'middleware'=>'roles',  // route middleware check role   
      'roles'=>['role_admin'] // allow role name ['role_name' , 'etc..']
    ]);

```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
