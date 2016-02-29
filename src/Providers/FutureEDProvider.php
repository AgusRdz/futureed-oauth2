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
			'uid'			=> $user['uid'],
			'token'			=> $user['token'],
			'full_name'		=> $user['full_name'],
			'first_name'	=> $user['first_name'],
			'last_name'		=> $user['last_name'],
			'email'			=> $user['email'],
			'nickname'		=> $user['nickname'],
			'avatar'		=> $user['avatar'],
			'birthdate'		=> $user['birthdate'],
			'gender'		=> $user['gender']
		]);
	}
}
