<?php
namespace FutureED\OAuth2\Contracts;

use Illuminate\Http\Request;

interface Provider {
	public function redirect();

	public function user(Request $request);
}