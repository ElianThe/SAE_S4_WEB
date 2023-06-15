<?php

namespace miniPress\admin\services\utils;

class CsrfService
{
    public static function generate(): string
    {
        $token = bin2hex(random_bytes(64));
        $_SESSION['csrf'] = $token;
        return $token;
    }

    /**
     * @throws CsrfException
     */
    public static function check(string $token): void
    {
        if (isset($_SESSION['csrf'])) {
            $sessionToken = $_SESSION['csrf'];
            unset($_SESSION['csrf']);
            if ($sessionToken === $token) {
                return;
            }
        }
        throw new CsrfException("CSRF token invalid");
    }
}