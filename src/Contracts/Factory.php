<?php
namespace FutureED\OAuth2\Contracts;

interface Factory {
	/**
   * Get an OAuth provider implementation.
   *
   * @param  string  $driver
   * @return \Laravel\Socialite\Contracts\Provider
   */
	public function driver($driver = null);
}
