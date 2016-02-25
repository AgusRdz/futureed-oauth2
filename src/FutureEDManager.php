<?php
namespace FutureED\OAuth2;

use InvalidArgumentException;
use Illuminate\Support\Manager;
use FutureED\OAuth2\Providers\FutureEDProvider;

class FutureEDManager extends Manager implements Contracts\Factory {

	/**
   * Get a driver instance.
   *
   * @param  string  $driver
   * @return mixed
   */
	public function with($driver) {
		return $this->driver($driver);
	}

	/**
   * Create an instance of the specified driver.
   *
   * @return \FutureED\OAuth2\AbstractProvider
   */
	protected function createFutureEDDriver() {
		$config = $this->app['config']['services.FutureED'];
		if(!is_null($config)) {
			return $this->buildProvider('FutureED\OAuth2\Providers\FutureEDProvider', $config);
		} else {
			throw new InvalidArgumentException("La configuración del servicio no ha sido establecida. Verifique su archivo config/services.php", 1);
		}
	}

	/**
   * Build an OAuth 2 provider instance.
   *
   * @param  string  $provider
   * @param  array  $config
   * @return \FutureED\OAuth2\AbstractProvider
   */
	public function buildProvider($provider, $config) {
		return new $provider($this->app['request'], $config['client_id'], $config['client_secret'], $config['redirect']);
	}

	/**
   * Format the server configuration.
   *
   * @param  array  $config
   * @return array
   */
	public function formatConfig(array $config) {
		return array_merge(['identifier' => $config['client_id'], 'secret' => $config['client_secret'], 'callback_uri' => $config['redirect'],], $config);
	}

	/**
	 * Get the default driver name.
	 *
	 * @throws \InvalidArgumentException
	 *
	 * @return string
	 */
	public function getDefaultDriver() {
		throw new InvalidArgumentException('No se ha especificado el driver encargado de hacer el redireccionamiento. Verifique su controlador.');
	}
}
