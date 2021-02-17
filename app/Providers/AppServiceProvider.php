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

		Validator::extend('has', function ($attribute, $value, $parameters, $validator)
		{
			if ($value)
			{
				if (User::find(auth()->user()->id)->{$parameters[0]}->contains($value))
					return true; 
				else
					throw new AuthorizationException("Unauthorized");
			}
		});

		Validator::extend('auth', function ($attribute, $value, $parameters, $validator)
		{
			if ($value)
			{
				if (auth()->user()->id == $value)
					return true; 
				else
					throw new AuthorizationException("Unauthorized");
			}
		});
	}
}
