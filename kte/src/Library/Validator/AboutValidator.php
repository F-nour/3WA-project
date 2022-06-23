<?php

namespace Library\Validator;

use \Library\Core\AbstractValidator;

class AboutValidator extends AbstractValidator
{
    /**
     * @brief Constructor.
     * @param array $data
     * @return array $this->errors
     */
    public function aboutForm(array $data): array
    {
        if (empty($data['society'])) {
            $this->errors['society'] = self::SOCIETY_INVALID;
        }
        if (empty($data['city']) || strlen($data['city']) < 3 || strlen($data['city']) > 50 || !is_string(
                $data['city']
            )) {
            $this->errors['city'] = self::CITY_INVALID;
        }
        if (empty($data['adress']) || strlen($data['adress']) < 3 || strlen($data['adress']) > 50 || !is_string(
                $data['adress']
            )) {
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
}