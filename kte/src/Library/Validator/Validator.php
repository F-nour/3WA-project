<?php

namespace Library\Validator;

use App\Model\Table\User;

class Validator
{
    
    private $errors = [];

    const ROLE_ID_INVALID = "Le rôle est invalide."; // Rôle invalide
    const SOCIETY_INVALID = "La société est invalide."; // Société invalide
    const LASTNAME_INVALID = "Nom de famille invalide."; // id de l'utilisateur
    const FIRSTNAME_INVALID = "Prénom invalide."; // role_id de l'utilisateur
    const ADRESS_INVALID = "Adresse invalide."; // nom de famille
    const ZIP_INVALID = "Code postal invalide."; // prénom
    const CITY_INVALID = "Ville invalide."; // numéro de téléphone
    const EMAIL_INVALID = "Email invalide."; // service
    const PASSWORD_INVALID = "Mot de passe invalide."; // adresse
    const PASSWORD_CONFIRM_INVALID = "Les deux champs doivent contenir les mêmes caractères."; // complément
    const TITLE_INVALID = "Titre invalide."; // complément
    const CONTENT_INVALID = "Contenu invalide."; // code postal
    const PRICE_INVALID = "Prix invalide."; // ville
    const QUANTITY_INVALID = "Quantité invalide."; // mot de passe

    public function userForm(array $data): array
    {
        $user = new User();
        
        if (empty($data['role_id'])) {
            $this->errors['role_id'] = self::ROLE_ID_INVALID;
        }
        if (empty($data['lastname']) || strlen($data('lastname')) <= 2 || !is_string($data['lastname'])) {
            $this->errors['lastname'] = self::LASTNAME_INVALID;
        }
        if (empty($data['fistname']) || strlen($data['fistname']) <= 2 || !is_string($data['fistname'])) {
            $this->errors['firstname'] = self::FIRSTNAME_INVALID;
        }
        if (empty($data['adress']) || strlen($data['adress']) <= 3 || !is_string($data['adress'])) {
            $this->errors['adress'] = self::ADRESS_INVALID;
        }
        if (empty($data['zip']) || strlen($data['zip']) != 5 || !is_numeric($data['zip'])) {
            $this->errors['zip'] = self::ZIP_INVALID;
        }
        if (empty($data['city']) || strlen($data['city']) <= 3 || !is_string($data['city'])) {
            $this->errors['city'] = self::CITY_INVALID;
        }
        if (empty($data['email']) || strlen($data['email']) <= 3 || !is_string($data['email']) || !filter_var(
                $data['email'],
                FILTER_VALIDATE_EMAIL
            )) {
            $this->errors['email'] = self::EMAIL_INVALID;
        }
        if (empty($data['password']) || strlen($data['password']) <= 6 || !is_string($data['password'])) {
            $this->errors['password'] = self::PASSWORD_INVALID;
        }
        if (empty($data['newPassword']) || strlen($data['newPassword']) <= 6 || !is_string($data['newPassword'])) {
            $this->errors['newPassword'] = self::PASSWORD_INVALID;
        }
        if (isset($data['password_confirm'])) {
            if (empty($data['password_confirm']) || strlen($data['password_confirm']) <= 6 || !is_string($data['password_confirm'])) {
                $this->errors['password_confirm'] = self::PASSWORD_INVALID;
            }
            if ($data['password'] !== $data['password_confirm']) {
                $this->errors['password_confirm'] = self::PASSWORD_CONFIRM_INVALID;
            }
            if ($data['newPassword'] !== $data['password_confirm']) {
                $this->errors['password_confirm'] = self::PASSWORD_CONFIRM_INVALID;
            }
        }
        return $this->errors;
    }

    public function actualityForm(array $data): array
    {
        $errors = [];
        if (empty($data['title']) || strlen($data['title']) <= 3 || !is_string($data['title'])) {
            $this->errors['title'] = self::TITLE_INVALID;
        }
        if (empty($data['content']) || strlen($data['content']) <= 3 || !is_string($data['content'])) {
            $this->errors['content'] = self::CONTENT_INVALID;
        }
        return $this->errors;
    }

    public function productForm(array $data)
    {
        $errors = [];
        if (empty($data['name']) || strlen($data['name']) <= 3 || !is_string($data['name'])) {
            $this->errors['name'] = self::TITLE_INVALID;
        }
        if (empty($data['description']) || strlen($data['description']) <= 3 || !is_string($data['description'])) {
            $this->errors['description'] = self::CONTENT_INVALID;
        }
        if (empty($data['price']) || strlen($data['price']) <= 3 || !is_string($data['price'])) {
            $this->errors['price'] = self::PRICE_INVALID;
        }
        if (empty($data['quantity']) || strlen($data['quantity']) <= 3 || !is_string($data['quantity'])) {
            $this->errors['quantity'] = self::QUANTITY_INVALID;
        }
        return $this->errors;
    }

    public function contactForm(array $data): array
    {
        $errors = [];
        if (empty($data['name']) || strlen($data['name']) <= 3 || !is_string($data['name'])) {
            $this->errors['name'] = self::TITLE_INVALID;
        }
        if (empty($data['email']) || strlen($data['email']) <= 3 || !is_string($data['email']) || !filter_var(
                $data['email'],
                FILTER_VALIDATE_EMAIL
            )) {
            $this->errors['email'] = self::EMAIL_INVALID;
        }
        if (empty($data['message']) || strlen($data['message']) <= 3 || !is_string($data['message'])) {
            $this->errors['message'] = self::CONTENT_INVALID;
        }
        return $this->errors;
    }

    public function aboutForm(array $data): array
    {
        $errors = [];
        if (empty($data['society'])) {
            $this->errors['society'] = self::SOCIETY_INVALID;
        }
        if (empty($data['city']) || strlen($data['city']) < 3 || strlen($data['city']) > 50 || !is_string($data['city'])) {
            $this->errors['city'] = self::CITY_INVALID;
        }
        if (empty($data['adress']) || strlen($data['adress']) < 3 || strlen($data['adress']) > 50 || !is_string($data['adress'])) {
            $this->errors['adress'] = self::ADRESS_INVALID;
        }
        if (empty($data['zip']) || strlen($data['zip']) != 5 || !is_numeric($data['zip'])) {
            $this->errors['zip'] = self::ZIP_INVALID;
        }
        if (empty($data['email']) || strlen($data['email']) <= 3 || !is_string($data['email']) || !filter_var(
                $data['email'],
                FILTER_VALIDATE_EMAIL
            )) {
            $this->errors['email'] = self::EMAIL_INVALID;
        }
        return $this->errors;
    }

    public function isValid() : bool
    {
        if (count($this->errors) > 0) {
            return false;
        } else {
            return true;
        }
    }
}