<?php
namespace FutureED\OAuth2\Facades;

use Illuminate\Support\Facades\Facade;

class FutureED extends Facade {
	protected static function getFacadeAccessor() {
		return 'FutureED\OAuth2\Contracts\Factory';
	}
}