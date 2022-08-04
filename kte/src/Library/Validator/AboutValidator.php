<?php

namespace Library\Validator;

use Library\Core\AbstractValidator;

class AboutValidator extends AbstractValidator
{
    /**
     * @brief Constructor.
     * @param array $data
     * @return array $this->errors
     */
    public function updateAbout(array $data): array
    {
        if (empty($data['society']) || strlen($data['society']) <= 3 || !is_string(
                $data['society']
            ) || !$this->security($data['society'])) {
            $this->errors['society'] = self::SOCIETY_INVALID;
        }
        if (empty($data['status']) || strlen($data['status']) <= 3 || !is_string(
                $data['status']
            ) || !$this->security($data['status'])) {
            $this->errors['status'] = self::STATUS_INVALID;
        }
        if (empty($data['INSEE']) || strlen($data['INSEE']) <= 3 || !is_string(
                $data['INSEE']
            )) {
            $this->errors['INSEE'] = self::INSEE_INVALID;
        }
        if (empty($data['zip']) || strlen($data['zip']) != 5 || !is_numeric($data['zip'])) {
            $this->errors['zip'] = self::ZIP_INVALID;
        }
        if (empty($data['city']) || strlen($data['city']) < 3 || strlen($data['city']) > 50 || !is_string(
                $data['city']
            ) || !$this->security($data['city'])) {
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
}