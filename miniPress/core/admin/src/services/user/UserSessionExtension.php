<?php

namespace miniPress\admin\services\user;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class UserSessionExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('isUserLoggedIn', [$this, 'isUserLoggedIn']),
        ];
    }

    public function isUserLoggedIn()
    {
        // Vérifiez si la variable de session "user" est définie
        return isset($_SESSION['user_id']);
    }
}
