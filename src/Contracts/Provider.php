<?php
namespace FutureED\OAuth2\Contracts;

use Illuminate\Http\Request;

interface Provider {
	/**
   * Redirect the user to the authentication page for the provider.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
	public function redirect();

	/**
   * Get the User instance for the authenticated user.
   *
   * @return \FutureED\OAuth2\Contracts\User
   */
	public function user(Request $request);
}
