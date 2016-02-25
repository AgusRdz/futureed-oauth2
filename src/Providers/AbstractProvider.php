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

	/**
   * The HTTP request instance.
   *
   * @var Request
   */
	protected $request;

	/**
	 * The client ID.
	 *
	 * @var string
	 */
	protected $clientId;

	/**
	 * The client secret.
	 *
	 * @var string
	 */
	protected $clientSecret;

	/**
	 * The redirect URL.
	 *
	 * @var string
	 */
	protected $redirectUrl;

	/**
   * Create a new provider instance.
   *
   * @param  Request  $request
   * @param  string  $clientId
   * @param  string  $clientSecret
   * @param  string  $redirectUrl
   * @return void
   */
	public function __construct(Request $request, $clientId, $clientSecret, $redirectUrl) {
		$this->base_uri = 'http://localhost:8000/api/v1.0/';
		$this->request = $request;
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;
		$this->redirectUrl = $redirectUrl;
	}

	/**
	 * Map the raw user array to a FutureED User instance.
	 *
	 * @param  array  $user
	 * @return \FutureED\OAuth2\User
	 */
	abstract protected function mapUserToObject(array $user);

	/**
	 * Remove the user array from mapped User instance.
	 *
	 * @param User	$user
	 * @return \FutureED\OAuth2\User
	 */
	protected function cleanUserObject(User $user) {
		unset($user->user);
		return $user;
	}

	/**
	 * Redirect the user of the application to the provider's authentication screen.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function redirect() {
		if(is_null(env('FUTUREED_CLIENT_ID')))
			throw new InvalidArgumentException("No se ha establecido el valor para FUTUREED_CLIENT_ID en el archivo .env.", 1);
		if(is_null(env('FUTUREED_CLIENT_SECRET')))
			throw new InvalidArgumentException("No se ha establecido el valor para FUTUREED_CLIENT_SECRET en el archivo .env.", 1);
		if(is_null(env('FUTUREED_REDIRECT_URI')))
			throw new InvalidArgumentException("No se ha establecido el valor para FUTUREED_REDIRECT_URI en el archivo .env.", 1);

		return Redirect::to($this->base_uri . 'auth/authorize?client_id=' . env('FUTUREED_CLIENT_ID') . '&state=' . env('FUTUREED_CLIENT_SECRET') . '&redirect_uri=' . env('FUTUREED_REDIRECT_URI'));
	}

	/**
	 * Get the user data if authorization code is valid.
	 *
	 * @param	\Illuminate\Http\Request
	 * @return \FutureED\OAuth2\User
	 */
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
