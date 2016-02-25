<?php
namespace FutureED\OAuth2\Contracts;

interface User {
	public function getId();

	public function getNickname();

	public function getFirstName();

	public function getLastName();

	public function getEmail();

	public function getAvatar();

	public function getToken();
}