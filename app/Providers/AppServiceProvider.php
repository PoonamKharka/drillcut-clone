<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ContentfulService;
use App\Services\DrillcutApiService;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ContentfulService::class);
        $this->app->bind(DrillcutApiService::class);
    }
    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Gate::define('add-product' , function(User $user) {
          if( $user->roles_id === 1 ) {
            return true;
          }  else {
            return false;
          }
       });

       Gate::define('show-analytic' , function(User $user) {
        if( $user->roles_id === 1 ) {
          return true;
        }  else {
          return false;
        }
     });
    }
}
