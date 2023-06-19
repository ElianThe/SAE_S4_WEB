<?php

namespace miniPress\admin\services\user;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use miniPress\admin\models\User;

class UserService
{

    public function checkPassword($password) : bool
    {
        if (strlen($password) < 8) {
            return false;
        }
        if (!preg_match("#[0-9]+#", $password)) {
            return false;
        }
        if (!preg_match("#[a-zA-Z]+#", $password)) {
            return false;
        }
        if (!preg_match("#[\W]+#", $password)) {
            return false;
        }
        return true;
    }

    public function existFromDatabase(string $email) : bool
    {
        try {
            User::where('email', $email)->firstOrFail();
            return true;
        } catch (ModelNotFoundException $exception) {
            return false;
        }
    }

    public function changePassword(string $email, string $password) : bool
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->save();
            return true;
        } catch (ModelNotFoundException $exception) {
            throw new UserNotFoundException('Utilisateur non trouvé', 404);
        }

    }

    public function isSamePassword(string $email, string $password) : bool
    {
        $user = User::where('email', $email)->firstOrFail();
        if (password_verify($password, $user->password)) {
            return true;
        }
        throw new UserNotFoundException('Mot de passe incorrect', 404);
    }

    public function signIn(string $email, string $password) : bool
    {
        if ($this->isSamePassword($email, $password)) {
            $user = User::where('email', $email)->firstOrFail();
            $_SESSION['user_id'] = $user->id;
            return true;
        }
        throw new UserNotFoundException('Mot de passe incorrect', 404);
    }

    public function register(array $attributs) : bool
    {
        if ($this->existFromDatabase($attributs['email'])) {
            throw new UserNotFoundException('Utilisateur déjà existant', 404);
        }
        if ($this->checkPassword($attributs['password'])) {
            $user = new User();
            $user->email = $attributs['email'];
            $user->password = password_hash($attributs['password'], PASSWORD_DEFAULT);
            $user->save();
            return true;
        }
        throw new UserNotFoundException('Mot de passe incorrect', 404);
    }
}