<?php
namespace FutureED\OAuth2\Contracts;

interface Factory {
	public function driver($driver = null);
}