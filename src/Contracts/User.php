<?php
namespace FutureED\OAuth2\Contracts;

interface User {
	/**
   * Get the unique identifier for the user.
   *
   * @return string
   */
	public function getUID();

	/**
   * Get the access token for the user.
   *
   * @return string
   */
	public function getToken();

   /**
   * Get the full name of the user.
   *
   * @return string
   */
   public function getFullName();

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
    * Get the nickname / username for the user.
    *
    * @return string
    */
   public function getNickname();

	/**
   * Get the e-mail address of the user.
   *
   * @return string
   */
	public function getEmail();

	/**
   * Get the avatar URL for the user.
   *
   * @return string
   */
	public function getAvatar();

   /**
    * Get the birthdate of the user.
    * @return date
    */
   public function getBirthdate();

   /**
    * Get the gender of the user.
    * @return string
    */
   public function getGender();
}
