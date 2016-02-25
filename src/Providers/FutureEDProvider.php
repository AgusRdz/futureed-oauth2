<?php
namespace FutureED\OAuth2\Providers;

use GuzzleHttp\ClientInterface;

class FutureEDProvider extends AbstractProvider implements ProviderInterface {
	/**
	 * Map the raw user array to a FutureED User instance.
	 *
	 * @param  array  $user
	 * @return \FutureED\OAuth2\User
	 */
	protected function mapUserToObject(array $user) {
		return (new User)->setRaw($user)->map([
			'id' => $user['id'],
			'token'	=> $user['token'],
			'nickname'	=> $user['nickname'],
			'first_name'	=> $user['first_name'],
			'last_name'	=> $user['last_name'],
			'email'	=> $user['email'],
			'avatar' => $user['avatar']
		]);
	}
}
