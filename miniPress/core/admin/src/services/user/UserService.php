<?php

namespace miniPress\core\admin\src\services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use miniPress\admin\models\User;

class UserService
{

    public function checkPassword($password) : bool
    {
        if (strlen($password) < 8) {
            throw new UserNotFoundException('Le mot de passe doit contenir au moins 8 caractères', 404);
        }
        if (!preg_match("#[0-9]+#", $password)) {
            throw new UserNotFoundException('Le mot de passe doit contenir au moins un chiffre', 404);
        }
        if (!preg_match("#[a-zA-Z]+#", $password)) {
            throw new UserNotFoundException('Le mot de passe doit contenir au moins une lettre', 404);
        }
        if (!preg_match("#[\W]+#", $password)) {
            throw new UserNotFoundException('Le mot de passe doit contenir au moins un caractère spécial', 404);
        }
        return true;
    }

    public function existFromDatabase(string $email) : bool
    {
        try {
            User::where('email', $email)->firstOrFail();
            return true;
        } catch (ModelNotFoundException $exception) {
            throw new UserNotFoundException('Utilisateur non trouvé', 404);
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
            $_SESSION['user'] = $this->getUserFromEmail($email);
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