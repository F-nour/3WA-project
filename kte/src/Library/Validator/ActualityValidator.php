<?php

namespace Library\Validator;

use Library\Core\AbstractValidator;

class ActualityValidator extends AbstractValidator
{
    /**
     * @brief Constructor.
     * @param array $data
     * @return array $this->errors
     */
    public function actualityForm(array $data): array
    {
        if (empty($data['title']) || strlen($data['title']) <= 3 || !is_string($data['title']) || !$this->security(
                $data['title']
            )) {
            $this->errors['title'] = self::TITLE_INVALID;
        }
        if (empty($data['content']) || strlen($data['content']) <= 3 || !is_string(
                $data['content']
            ) || !$this->security($data['content'])) {
            $this->errors['content'] = self::CONTENT_INVALID;
        }
        return $this->errors;
    }
}