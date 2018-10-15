<?php namespace Zaengle\Timezone;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class TimezoneServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return null
	 */
	public function boot()
	{
        $this->publishes([
            __DIR__.'/../config/timezone.php' => config_path('timezone.php'),
        ], 'config');

	}

	/**
	 * Register the service provider.
	 *
	 * @return null
	 */
	public function register()
	{
        $this->mergeConfigFrom(__DIR__.'/../config/timezone.php', 'timezone');

        $this->app->singleton(Timezone::class, function($app) {
            return new Timezone();
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [Timezone::class];
	}

}
