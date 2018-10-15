<?php namespace Zaengle\Timezone;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class TimezoneServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

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

        $this->app->alias('Timezone', Timezone::class);
	}

	/**
	 * Register the service provider.
	 *
	 * @return null
	 */
	public function register()
	{
        $this->mergeConfigFrom(__DIR__.'/../config/timezone.php', 'timezone');
		$this->app->bind('timezone', Timezone::class);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
