<?php
namespace FutureED\OAuth2\Providers;

use Illuminate\Http\Request;

interface ProviderInterface {
	/**
   * Redirect the user to the authentication page for the provider.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
	public function redirect();

	/**
   * Get the User instance for the authenticated user.
   *
   * @return \FutureED\OAuth2\User
   */
	public function user(Request $request);
}
