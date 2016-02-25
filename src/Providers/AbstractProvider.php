<?php
namespace FutureED\OAuth2\Providers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Symphony\Component\HttpFoundation\RedirectResponse;
use FutureED\OAuth2\Contracts\Provider as ProviderContract;
use Illuminate\Support\Facades\Redirect;

abstract class AbstractProvider implements ProviderContract {

	protected $base_uri;

	protected $request;

	protected $clientId;

	protected $clientSecret;

	protected $redirectUrl;

	protected $parameters = [];

	protected $scopes = [];

	protected $scopeSeparator = ',';

	protected $encodingType = PHP_QUERY_RFC1738;

	protected $stateless = false;

	public function __construct(Request $request, $clientId, $clientSecret, $redirectUrl) {
		$this->base_uri = 'http://localhost:8000/api/v1.0/';
		$this->request = $request;
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;
		$this->redirectUrl = $redirectUrl;
	}

	abstract protected function mapUserToObject(array $user);

	protected function cleanUserObject(User $user) {
		unset($user->user);
		return $user;
	}

	public function redirect() {
		return Redirect::to($this->base_uri . 'auth/authorize?client_id=' . env('FUTUREED_CLIENT_ID'));
	}

	public function user(Request $request) {
		try {
			$client = new Client(['base_uri' => $this->base_uri]);
			$redirect_uri = $request->query('redirect_uri');
      		$code = $request->query('code');
      		$client_id = $request->query('client_id');
      		$client_secret = $request->query('state');
      		$grant_type = $request->query('grant_type');
      		$email = $request->query('email');
      		$getToken = $this->base_uri . 'auth/access_token?code=' . $code . '&client_id=' . $client_id . '&client_secret=' . $client_secret . '&grant_type=' . $grant_type . '&redirect_uri=' . $redirect_uri . '&email=' . $email;
      		$response = $client->request('GET', $getToken);
      		$json = $response->getBody();
      		return $this->cleanUserObject($this->mapUserToObject(json_decode($json, true)));
      	} catch(\Exception $e) {
      		return $e->getMessage();
      	}		
		
	}

	

}