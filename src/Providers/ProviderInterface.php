<?php
namespace FutureED\OAuth2\Providers;

use Illuminate\Http\Request;

interface ProviderInterface {
	public function redirect();

	public function user(Request $request);
}