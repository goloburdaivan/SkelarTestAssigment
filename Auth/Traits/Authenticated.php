<?php

use Responses\UnauthorizedResponse;

require_once './Stubs/AuthStubs.php';
require_once './Responses/UnauthorizedResponse.php';

/*
 *  I`m using here Basic Auth, because I think, if I have used something like JWT tokens
 * it would be too complex for service like this
*/

trait Authenticated
{
    private function checkAuthorization(): bool
    {
        global $auths; // this is our stubs, lets assume that this bad code will be replaced with database
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            return false;
        }
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        $user = array_filter($auths, fn ($element) => $element->username == $username);
        if (empty($user))
            return false;

        $user = reset($user);
        return $username === $user->username
            && password_verify($password, $user->password);
    }

    private function requireAuthorization(): void
    {
        if (!$this->checkAuthorization()) {
            echo new UnauthorizedResponse();
            exit;
        }
    }
}