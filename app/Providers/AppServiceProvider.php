<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('belongsToMe', function ($attribute, $value, $parameters, $validator)
        {
         if ($value)
         {
             if (count(User::find(auth()->user()->id)->{$parameters[0]}()->where('id', $value)->get()))
                 return true; 
             else
                 throw new AuthorizationException("Unauthorized");
         }
        });

        Validator::extend('belongsToManyMe', function ($attribute, $value, $parameters, $validator)
        {
         if ($value)
         {
             if (count(User::find(auth()->user()->id)->{$parameters[0]}()->where("$parameters[0].id", $value)->get()))
                 return true; 
             else
                 throw new AuthorizationException("Unauthorized");
         }
        });
    }
}
