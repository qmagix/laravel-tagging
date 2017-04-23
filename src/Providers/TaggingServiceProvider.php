<?php

namespace Qmagix\Tagging\Providers;

use Illuminate\Support\ServiceProvider;
use Qmagix\Tagging\Contracts\TaggingUtility;
use Qmagix\Tagging\Util;

/**
 * Copyright (C) 2014 Robert Qmagix
 */
class TaggingServiceProvider extends ServiceProvider
{

	protected $commands = [
		\Qmagix\Tagging\Console\Commands\GenerateTagGroup::class
	];


	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../../config/tagging.php' => config_path('tagging.php')
		], 'config');

		$this->publishes([
			__DIR__.'/../../migrations/' => database_path('migrations')
		], 'migrations');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->commands($this->commands);

		$this->app->singleton(TaggingUtility::class, function () {
			return new Util;
		});
	}

	/**
	 * (non-PHPdoc)
	 * @see \Illuminate\Support\ServiceProvider::provides()
	 */
	public function provides()
	{
		return [TaggingUtility::class];
	}
}
