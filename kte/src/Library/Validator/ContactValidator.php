<?php

namespace Library\Validator;

use Library\Core\AbstractValidator;

class ContactValidator extends AbstractValidator
{
    /**
     * @brief Constructor.
     * @param array $data
     * @return array $this->errors
     */
    public function contactForm(array $data): array
    {
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
}