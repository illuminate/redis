<?php namespace Illuminate\Redis;

use Illuminate\Support\ServiceProvider;

class RedisServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['redis'] = $this->app->share(function($app)
		{
			return new RedisManager($app);
		});
	}

}