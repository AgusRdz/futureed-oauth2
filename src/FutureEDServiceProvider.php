<?php
namespace FutureED\OAuth2;

use Illuminate\Support\ServiceProvider;

class FutureEDServiceProvider extends ServiceProvider {

	protected $defer = true;

	public function register() {
		$this->app->singleton('FutureED\OAuth2\Contracts\Factory', function($app) {
			return new FutureEDManager($app);
		});
	}

	public function provides() {
		return ['FutureED\OAuth2\Contracts\Factory'];
	}
}