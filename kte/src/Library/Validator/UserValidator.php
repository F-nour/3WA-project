<?php

namespace Library\Validator;

use Library\Core\AbstractValidator;

class UserValidator extends AbstractValidator
{
    /**
     * @brief Constructor.
     * @param array $data
     * @return array $this->errors
     */
    public function createUser(array $data): array
    {
        if (empty($data['lastname']) || strlen($data['lastname']) <= 2 || !is_string($data['lastname'])) {
            $this->errors['lastname'] = self::LASTNAME_INVALID;
        }
        if (empty($data['firstname']) || strlen($data['firstname']) <= 2 || !is_string($data['firstname'])) {
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
        if (empty($data['passwordConfirm']) || strlen($data['passwordConfirm']) <= 6 || !is_string(
                $data['passwordConfirm']
            ) || $data['password'] !== $data['passwordConfirm']
        ) {
            $this->errors['passwordConfirm'] = self::PASSWORD_CONFIRM_INVALID;
        }
        return $this->errors;
    }

    public function authUser(object $user, bool $password): array {
        if (!$user) {
            $this->errors['email'] = self::EMAIL_INVALID;
        }
        if (!$password) {
            $this->errors['password'] = self::PASSWORD_INVALID;
        }
        return $this->errors;
    }

    public function modifyUser(array $data): array
    {
        if (empty($data['lastname']) || strlen($data['lastname']) <= 2 || !is_string($data['lastname'])) {
            $this->errors['lastname'] = self::LASTNAME_INVALID;
        }
        if (empty($data['firstname']) || strlen($data['firstname']) <= 2 || !is_string($data['firstname'])) {
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
        return $this->errors;
    }

    public function updatePwd(array $data, bool $password): array
    {
        if (!$password) {
            $this->errors['actualPassword'] = self::PASSWORD_INVALID;
        }
        if (empty($data['newPassword']) || $data['newPassword'] === $data['actualPassword'] || strlen(
                $data['newPassword']
            ) <= 6 || !is_string($data['newPassword'])) {
            $this->errors['newPassword'] = self::NEW_PASSWORD_INVALID;
        }
        if (empty($data['passwordConfirm']) || strlen($data['passwordConfirm']) <= 6 || !is_string(
                $data['passwordConfirm']
            ) || $data['newPassword'] !== $data['passwordConfirm']
        ) {
            $this->errors['passwordConfirm'] = self::PASSWORD_CONFIRM_INVALID;
        }
        return $this->errors;
    }
}