<?php
namespace FutureED\OAuth2;

use ArrayAccess;

abstract class AbstractUser implements ArrayAccess, Contracts\User
{
    /**
     * The unique identifier for the user.
     *
     * @var mixed
     */
    public $uid;

    /**
     * The user's access token.
     *
     * @var string
     */
    public $token;

    /**
     * The user's full name.
     *
     * @var string
     */
    public $full_name;
    
    /**
     * The user's first name.
     *
     * @var string
     */
    public $first_name;

    /**
     * The user's last name.
     *
     * @var string
     */
    public $last_name;

    /**
     * The user's nickname / username.
     *
     * @var string
     */
    public $nickname;

    /**
     * The user's e-mail address.
     *
     * @var string
     */
    public $email;

    /**
     * The user's avatar image URL.
     *
     * @var string
     */
    public $avatar;

    /**
     * The user's birthdate.
     * @var date
     */
    public $birthdate;

    /**
     * The user's gender.
     * @var string
     */
    public $gender;

    /**
     * Get the unique identifier for the user.
     *
     * @return string
     */
    public function getUID()
    {
        return $this->uid;
    }

    /**
     * Get the full name of the user.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * Get the first name of the user.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the last name of the user.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get the nickname / username for the user.
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Get the e-mail address of the user.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the avatar / image URL for the user.
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get the access token of the user.
     *
     * @return string
     */
    public function getToken() {
    	return $this->token;
    }

    /**
     * Get the birthdate of the user.
     *
     * @return string
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Get the gender of the user.
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the raw user array from the provider.
     *
     * @param  array  $user
     * @return $this
     */
    public function setRaw(array $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Map the given array onto the user's properties.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function map(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
        return $this;
    }

    /**
     * Determine if the given raw user attribute exists.
     *
     * @param  string  $offset
     * @return  bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->user);
    }

    /**
     * Get the given key from the raw user.
     *
     * @param  string  $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->user[$offset];
    }

    /**
     * Set the given attribute on the raw user array.
     *
     * @param  string  $offset
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->user[$offset] = $value;
    }

    /**
     * Unset the given value from the raw user array.
     *
     * @param  string  $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->user[$offset]);
    }
}
