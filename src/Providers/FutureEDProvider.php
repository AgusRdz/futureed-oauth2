<?php
namespace FutureED\OAuth2\Providers;

use GuzzleHttp\ClientInterface;

class FutureEDProvider extends AbstractProvider implements ProviderInterface {

	protected $scopeSeparator = ',';

	protected $version = '1.0';

	protected $scopes = ['email', 'profile', 'user'];

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