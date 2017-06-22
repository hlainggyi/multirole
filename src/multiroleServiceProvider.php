<?php

namespace learn88\multirole;

use Illuminate\Support\ServiceProvider;

class multiroleServiceProvider extends ServiceProvider
{

   /**
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
   protected $defer = false;

   /**
    * The console commands.
    *
    * @var bool
    */
   protected $commands = [
       'learn88\multirole\MultiAuthRoleCommand',
   ];

   /**
    * Perform post-registration booting of services.
    *
    * @return void
    */
   public function boot()
   {
       $this->loadMigrationsFrom(__DIR__.'/database/migrations');
       $this->loadRoutesFrom(__DIR__.'/kopin/routes.php');
       $this->loadViewsFrom(__DIR__.'/kopin/views', 'show');
   }

   /**
    * Register any package services.
    *
    * @return void
    */
   public function register()
   {
       $this->commands($this->commands);
   }

   /**
    * Get the services provided by the provider.
    *
    * @return array
    */
   public function provides()
   {
       return ['multirole'];
   }
}
