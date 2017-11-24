<?php
namespace Flexi\Auth;

/**
 * Class Authenticatable
 * @package Flexi\Auth
 */
trait Authenticatable
{
    /**
     * Encrypts the password.
     *
     * @return string
     */
    public function encryptPassword(): string
    {
        $password   = $this->password;
        $salt       = $this->salt ?? $this->salt = Auth::salt();

        return $this->password = Auth::encryptPassword($password, $salt);
    }

    /**
     * Authorizes the user.
     *
     * @param  string  $username  The users username.
     * @param  string  $password  The users password.
     * @return bool
     */
    public static function authorize(string $username, string $password): bool
    {
        // Get the username field name.
        $field = Auth::usernameField();

        // Find user by thier username.
        $user = static::where($field, '=', $username)->first();

        // Was a user found?
        if (is_object($user)) {
            // If a user was found, ensure they have a valid password.
            if ($user->password === Auth::encryptPassword($password, $user->salt)) {
                // Authorize the user.
                Auth::authorize($user);

                // Success.
                return true;
            }
        }

        // Failure.
        return false;
    }
}
