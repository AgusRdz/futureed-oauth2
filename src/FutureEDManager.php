<?php
namespace FutureED\OAuth2;

use InvalidArgumentException;
use Illuminate\Support\Manager;
use FutureED\OAuth2\Providers\FutureEDProvider;

class FutureEDManager extends Manager implements Contracts\Factory {

	public function with($driver) {
		return $this->driver($driver);
	}

	protected function createFutureEDDriver() {
		$config = $this->app['config']['services.futureed'];
		return $this->buildProvider('FutureED\OAuth2\Providers\FutureEDProvider', $config);
	}

	public function buildProvider($provider, $config) {
		return new $provider($this->app['request'], $config['client_id'], $config['client_secret'], $config['redirect']);
	}

	public function formatConfig(array $config) {
		return array_merge(['identifier' => $config['client_id'], 'secret' => $config['client_secret'], 'callback_uri' => $config['redirect'],], $config);
	}

	public function getDefaultDriver() {
		throw new InvalidArgumentException('No se ha especificado el driver.');
	}
}