<?php
namespace FutureED\OAuth2\Contracts;

interface User {
	/**
   * Get the unique identifier for the user.
   *
   * @return string
   */
	public function getId();

	/**
	 * Get the nickname / username for the user.
	 *
	 * @return string
	 */
	public function getNickname();

	/**
   * Get the access token for the user.
   *
   * @return string
   */
	public function getToken();

	/**
   * Get the first name of the user.
   *
   * @return string
   */
	public function getFirstName();

	/**
   * Get the last name of the user.
   *
   * @return string
   */
	public function getLastName();

	/**
   * Get the e-mail address of the user.
   *
   * @return string
   */
	public function getEmail();

	/**
   * Get the avatar / image URL for the user.
   *
   * @return string
   */
	public function getAvatar();
}
