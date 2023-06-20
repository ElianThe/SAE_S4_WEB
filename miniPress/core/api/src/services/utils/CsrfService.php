<?php
namespace miniPress\api\services\utils;

use Exception;

class CsrfService {
    /**
     * generate() : generates a token, stores it in session and returns
     * @throws Exception
     */
    public static function generateToken():string {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    /**
     * check() : compares the received token to the token stored in session,
     * raises an exception in case of failure,
     * removes the token in session.
     * @throws Exception
     */
    public static function checkToken($token) :void {
        if(!isset($_SESSION['csrf_token'])){ // check if the token is store in the session
            throw new Exception("token is missing");
        }
        $storedToken = $_SESSION['csrf_token'];
        if ($token !== $storedToken){
            throw new Exception("token verification failed");
        }
        unset($_SESSION['csrf_token']);
    }
}