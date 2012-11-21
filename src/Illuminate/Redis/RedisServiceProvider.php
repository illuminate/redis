<?php namespace Illuminate\Redis;

use Illuminate\Support\ServiceProvider;

class RedisServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @param  Illuminate\Foundation\Application  $app
	 * @return void
	 */
	public function register($app)
	{
		$app['redis'] = $app->share(function($app)
		{
			return new RedisManager($app);
		});
	}

}