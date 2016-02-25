<?php
namespace FutureED\OAuth2\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FutureED\OAuth2\FutureEDManager
 */
class FutureED extends Facade {
	/**
   * Get the registered name of the component.
   *
   * @return string
   */
	protected static function getFacadeAccessor() {
		return 'FutureED\OAuth2\Contracts\Factory';
	}
}
